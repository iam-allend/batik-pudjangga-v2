<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display order details
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Verify payment proof
     */
    public function verifyPayment(Request $request, Order $order)
    {
        try {
            // Validate that order has payment proof
            if (!$order->payment_proof) {
                return back()->with('error', 'No payment proof found for this order.');
            }

            // Validate that payment is still pending
            if ($order->payment_status !== 'pending') {
                return back()->with('error', 'This payment has already been processed.');
            }

            $action = $request->input('action');

            DB::beginTransaction();

            if ($action === 'verify') {
                // Approve payment
                $order->update([
                    'payment_status' => 'verified',
                    'payment_verified_at' => now(),
                    'payment_verified_by' => auth()->id(),
                    'status' => 'processing' // Auto update order status to processing
                ]);

                DB::commit();

                // Optional: Send email notification to customer
                // Mail::to($order->user->email)->send(new PaymentVerifiedMail($order));

                Log::info('Payment verified', [
                    'order_id' => $order->id,
                    'order_code' => $order->order_code,
                    'verified_by' => auth()->id()
                ]);

                return redirect()
                    ->route('admin.orders.show', $order)
                    ->with('success', 'Payment has been verified successfully. Order status updated to Processing.');

            } elseif ($action === 'reject') {
                // Validate rejection note
                $request->validate([
                    'rejection_note' => 'required|string|min:10|max:500'
                ]);

                // Reject payment
                $order->update([
                    'payment_status' => 'rejected',
                    'payment_rejection_note' => $request->rejection_note,
                    'payment_rejected_at' => now(),
                    'payment_rejected_by' => auth()->id(),
                ]);

                DB::commit();

                // Optional: Send email notification to customer
                // Mail::to($order->user->email)->send(new PaymentRejectedMail($order));

                Log::info('Payment rejected', [
                    'order_id' => $order->id,
                    'order_code' => $order->order_code,
                    'reason' => $request->rejection_note,
                    'rejected_by' => auth()->id()
                ]);

                return redirect()
                    ->route('admin.orders.show', $order)
                    ->with('success', 'Payment has been rejected. Customer will be notified.');
            }

            DB::rollBack();
            return back()->with('error', 'Invalid action.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Payment verification error', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'An error occurred while processing payment verification.');
        }
    }

    /**
     * Update order status
     * FLEXIBLE: Admin can update status freely without strict payment verification check
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        try {
            DB::beginTransaction();

            // REMOVED: Strict validation for unverified payment
            // Admin now has full control to update status regardless of payment status
            
            // Optional: Add warning log if processing without verified payment
            if ($request->status === 'processing' && 
                $order->payment_method === 'transfer' && 
                $order->payment_status !== 'verified') {
                
                Log::warning('Order processed without verified payment', [
                    'order_id' => $order->id,
                    'order_code' => $order->order_code,
                    'payment_status' => $order->payment_status,
                    'updated_by' => auth()->id()
                ]);
            }

            $oldStatus = $order->status;
            
            $order->update([
                'status' => $request->status,
                'status_updated_at' => now(),
                'status_updated_by' => auth()->id()
            ]);

            // Auto-complete order if status is completed
            if ($request->status === 'completed' && $oldStatus !== 'completed') {
                $order->update([
                    'completed_at' => now()
                ]);
            }

            DB::commit();

            // Optional: Send status update email to customer
            // Mail::to($order->user->email)->send(new OrderStatusUpdatedMail($order));

            Log::info('Order status updated', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'old_status' => $oldStatus,
                'new_status' => $request->status,
                'updated_by' => auth()->id()
            ]);

            return back()->with('success', 'Order status updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Order status update error', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to update order status.');
        }
    }

    /**
     * Add or update resi code
     */
    public function addResi(Request $request, Order $order)
    {
        $request->validate([
            'resi_code' => 'required|string|max:100'
        ]);

        try {
            $order->update([
                'resi_code' => $request->resi_code,
                'resi_updated_at' => now(),
                'resi_updated_by' => auth()->id()
            ]);

            // Auto update status to shipped if still processing
            if ($order->status === 'processing') {
                $order->update([
                    'status' => 'shipped',
                    'shipped_at' => now()
                ]);
            }

            // Optional: Send resi notification to customer
            // Mail::to($order->user->email)->send(new ResiCodeAddedMail($order));

            Log::info('Resi code updated', [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'resi_code' => $request->resi_code,
                'updated_by' => auth()->id()
            ]);

            return back()->with('success', 'Tracking number updated successfully.');

        } catch (\Exception $e) {
            Log::error('Resi code update error', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to update tracking number.');
        }
    }

    /**
     * Get orders list (for index page)
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status !== 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        // Search by order code or customer name
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->paginate(20);

        // Get statistics
        $statistics = [
            'total_orders' => Order::count(),
            'pending_payment' => Order::where('payment_status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'completed' => Order::where('status', 'completed')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statistics'));
    }

   /**
     * Batch update order status
     * FLEXIBLE: No strict payment validation
     */
    public function batchUpdateStatus(Request $request)
    {
        // Decode JSON string to array first
        $orderIds = json_decode($request->order_ids, true);
        
        // Replace the order_ids in request with decoded array for validation
        $request->merge(['order_ids' => $orderIds]);
        
        $request->validate([
            'order_ids' => 'required|array|min:1',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        try {
            DB::beginTransaction();

            $orders = Order::whereIn('id', $orderIds)->get();
            $successCount = 0;
            $warningCount = 0;

            foreach ($orders as $order) {
                // REMOVED: Strict validation
                // Optional: Count warnings for unverified payments
                if ($request->status === 'processing' && 
                    $order->payment_method === 'transfer' && 
                    $order->payment_status !== 'verified') {
                    
                    $warningCount++;
                    
                    Log::warning('Batch: Order processed without verified payment', [
                        'order_id' => $order->id,
                        'order_code' => $order->order_code,
                        'payment_status' => $order->payment_status,
                        'updated_by' => auth()->id()
                    ]);
                }

                $oldStatus = $order->status;
                
                $updateData = [
                    'status' => $request->status,
                    'status_updated_at' => now(),
                    'status_updated_by' => auth()->id()
                ];

                // Auto-complete order if status is completed
                if ($request->status === 'completed' && $oldStatus !== 'completed') {
                    $updateData['completed_at'] = now();
                }

                // Auto-set shipped_at if status is shipped
                if ($request->status === 'shipped' && $oldStatus !== 'shipped') {
                    $updateData['shipped_at'] = now();
                }

                $order->update($updateData);

                Log::info('Batch order status updated', [
                    'order_id' => $order->id,
                    'order_code' => $order->order_code,
                    'old_status' => $oldStatus,
                    'new_status' => $request->status,
                    'updated_by' => auth()->id()
                ]);

                $successCount++;
            }

            DB::commit();

            $message = "{$successCount} order(s) updated successfully.";
            
            // Optional: Add info message if there were unverified payments
            if ($warningCount > 0) {
                $message .= " ({$warningCount} order(s) processed with unverified payment.)";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Batch order status update error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Failed to update order statuses: ' . $e->getMessage());
        }
    }
}