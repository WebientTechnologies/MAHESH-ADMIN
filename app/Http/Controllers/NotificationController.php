<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Notification;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Messaging\RawMessage;
use Kreait\Firebase\Messaging\SendReport;
use Kreait\Firebase\Messaging\SendMessage;
use Kreait\Firebase\Messaging\TopicManagement\SubscribeToTopic;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\AndroidConfig;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->user()->id)->orderByDesc('created_at')->get();

        return view('notifications.create', compact('notifications'));
    }

    public function create()
    {
        $users = Family::all();
       // dd( $users);
        return view('notifications.create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = Family::findOrFail($request->user_id);

        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'body' => $request->body,
            'image_url' => $request->image_url,
        ]);

        $this->sendNotification($request);

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

    public function sendNotification(Request $request)
    {
        $users = $request->input('users');
        $title = $request->input('title');
        $message = $request->input('message');
        $image = $request->file('image');

        // Check if the "all" option was selected
        if (in_array('all', $users)) {
            $users = Family::pluck('device_token')->toArray();
        } else {
            $users = Family::whereIn('id', $users)->pluck('device_token')->toArray();
        }

        // Send the notification to the selected users
        $factory = (new Factory)->withServiceAccount(__DIR__.'/community.json');
        $messaging = $factory->createMessaging();

        $notification = Notification::create($title, $message);
        $androidConfig = AndroidConfig::fromArray(['notification' => ['image' => $image]]);
        $message = CloudMessage::withTarget('token', $users)->withNotification($notification)->withAndroidConfig($androidConfig);

        $response = $messaging->send($message);

        return redirect()->back()->with('success', 'Notification sent successfully!');
    }

    private function sendMessage(SendMessage $message): SendReport
    {
        $messaging = app('firebase.messaging');

        return $messaging->send($message);
    }
}

