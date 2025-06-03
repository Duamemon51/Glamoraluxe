<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
  
    public function store(Request $request)
    {
        $request->validate([
            'c_fname' => 'required|string|max:255',
            'c_lname' => 'required|string|max:255',
            'c_email' => 'required|email',
            'c_subject' => 'nullable|string',
            'c_message' => 'nullable|string',
        ]);
    
        Contact::create([
            'first_name' => $request->c_fname,
            'last_name' => $request->c_lname,
            'email' => $request->c_email,
            'subject' => $request->c_subject,
            'message' => $request->c_message,
        ]);
    
        return redirect()->route('thankyou');
    }
    public function index()
    {
        $messages = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('messages'));
    }



public function show($id)
{
    $message = Contact::findOrFail($id);
    $message->update(['is_read' => true]); // Mark as read when opened
    return view('admin.contacts.show', compact('message'));
}

public function destroy($id)
{
    $message = Contact::findOrFail($id);
    $message->delete();
    return redirect()->route('admin.contacts')->with('success', 'Message deleted successfully.');
}

public function toggleRead($id)
{
    $message = Contact::findOrFail($id);
    $message->is_read = !$message->is_read;
    $message->save();

    return back()->with('success', 'Message status updated.');
}
public function dashboard()
{
    // Fetch recent orders (you can modify this query based on your requirements)
    $recentOrders = Order::latest()->take(5)->get(); // Fetch the 5 most recent orders

    // Pass the data to the view
    return view('admin.dashboard', compact('recentOrders'));
}

}
