<?php

namespace App\Http\Controllers\tenant;

use App\Http\Controllers\Controller;
use App\Models\PropertyListing;
use App\Models\Reminder;
use Illuminate\Http\Request;


class ReminderController extends Controller
{
    public function showReminder()
    {
        $tenantId = auth()->guard('tenant')->user()->tenant_id;
        // $tenantEmail = auth()->guard('tenant')->user()->email;
        $reminders = Reminder::where('tenant_id', $tenantId)->with('propertyListing')->get();

        foreach ($reminders as $reminder) {
            $property = $reminder->propertyListing;
            $propertyPrice = $reminder->propertyListing->property_price;
            $desiredPrice = $reminder->desired_price;
    
            if ($propertyPrice < $desiredPrice) {
                $reminder->price_change_indicator = 'decreased';

                // Mail::to($tenantEmail)->send(new PriceChangedMail($property, $reminder));

            } elseif ($propertyPrice > $desiredPrice) {
                $reminder->price_change_indicator = 'increased';
            } else {
                $reminder->price_change_indicator = 'same';
            }
        }

        return view('tenant.reminder.reminder', ['reminders'=>$reminders]);
    }

    public function addReminder($propertyId)
    {
        $property = PropertyListing::findOrFail($propertyId);
        $tenant = auth()->guard('tenant')->user()->tenant_id;

        $latestReminder = Reminder::latest('reminder_id')->first();
        $lastReminderId = $latestReminder ? $latestReminder->reminder_id : 'R0000';
        $reminderId = 'R' . str_pad((int) substr($lastReminderId, 1) + 1, 4, '0', STR_PAD_LEFT);

        Reminder::create([
            'reminder_id'       => $reminderId,
            'original_price'    => $property->property_price,
            'tenant_id'         => $tenant,
            'property_id'       => $property->property_id,
        ]);

        return redirect()->back()->with('info', 'Done add to reminder!');
    }

    public function showEditReminder($id)
    {
        $reminder = Reminder::findOrFail($id);
        return view('tenant.reminder.editReminder', ['reminder'=>$reminder]);
    }

    public function editReminder(Request $request, $reminderId)
    {
        $request->validate([
            'desired_price'     => 'required|numeric',
        ]);

        $reminder = Reminder::findOrFail($reminderId);
        $property = $reminder->propertyListing;
    
        $ori_price = $property->property_price;
        $desired_price = $request->desired_price;

        $reminder->update([
            'desired_price'             => $desired_price,
            'price_change_indicator'    => ($ori_price < $desired_price) ? 'increased' : (($ori_price > $desired_price) ? 'decreased' : 'same'),
        ]);

        return redirect()->route('showReminder')->with('info', 'Done updating the reminder listing!');
    }
}
