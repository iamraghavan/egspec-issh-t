<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentRegistry;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    private $razorpayId = 'rzp_test_xBOnn1if1rXI8H';
    private $razorpayKey = 'KcM9f04lMUjaQfZplvN0b4PU';

    public function showPaymentForm()
    {
        return view('payment-form'); // Render the payment form view
    }

    public function makePayment(Request $request)
    {
        $api = new Api($this->razorpayId, $this->razorpayKey);

        $order = $api->order->create([
            'receipt' => 'order_rcptid_11',
            'amount' => 100, // Amount in paise (INR 100.00)
            'currency' => 'INR'
        ]);

        return view('razorpay-checkout', ['order' => $order->id, 'amount' => 10000]);
    }

    public function handlePayment(Request $request)
    {
        $signature = $request->razorpay_signature;
        $orderId = $request->razorpay_order_id;
        $paymentId = $request->razorpay_payment_id;

        $api = new Api($this->razorpayId, $this->razorpayKey);

        try {
            $attributes = [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Store the order ID and payment ID in session
            session(['order_id' => $orderId, 'payment_id' => $paymentId]);

            // Redirect to the success page
            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            // Payment verification failed
            return redirect()->route('payment.failure')->withErrors('Payment verification failed!');
        }
    }

    public function paymentSuccess()
    {
        // Retrieve the order ID and payment ID from session
        $orderId = session('order_id');
        $paymentId = session('payment_id');

        // Pass them to the view
        return view('payment-success', compact('orderId', 'paymentId'));
    }

    public function paymentFailure()
    {
        return view('payment-failure'); // Render the failure page
    }


    public function createOrder(Request $request)
    {
        try {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

            $orderData = [
                'receipt'         => 'order_rcptid_11',
                'amount'          => $request->amount, // Amount in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // Auto capture payment
            ];

            $order = $api->order->create($orderData); // Creates order
            return response()->json(['order_id' => $order['id']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function storePaymentDetails(Request $request)
    {
        $validatedData = $request->validate([
            'event_registration_id' => 'required|integer',
            'payment_id' => 'required|string|max:100',
            'order_id' => 'required|string|max:100',
            'invoice_id' => 'nullable|string|max:100',
            'payment_method' => 'nullable|string|max:100',
            'payment_time' => 'nullable|date',
            'payment_data' => 'nullable|string',
        ]);

        PaymentRegistry::create($validatedData);

        return response()->json(['success' => true]);
    }
}
