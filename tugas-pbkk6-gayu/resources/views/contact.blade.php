@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-6">Contact us</h2>
    <form method="POST" action="{{ route('contact.submit') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label for="fullname" class="block text-sm font-medium">Full name *</label>
            <input type="text" id="fullname" name="fullname" required class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium">Email *</label>
            <input type="email" id="email" name="email" placeholder="your@email.com" required class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="subject" class="block text-sm font-medium">Subject *</label>
            <select id="subject" name="subject" required class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="" selected disabled>Select a subject</option>
                <option value="general">General Inquiry</option>
                <option value="support">Support</option>
                <option value="feedback">Feedback</option>
            </select>
        </div>
        <div>
            <label for="message" class="block text-sm font-medium">Message *</label>
            <textarea id="message" name="message" rows="4" placeholder="Write your message" required class="mt-1 block w-full rounded-md bg-gray-800 border-gray-700 text-white focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>
        <div>
            <label for="attachments" class="block text-sm font-medium">Attach Files</label>
            <input type="file" id="attachments" name="attachments[]" multiple class="mt-1 block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-600">
            <p class="mt-1 text-sm text-gray-400">Attach up to 10 files. Max file size: 20 MB.</p>
        </div>
        <div>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Send
            </button>
        </div>
    </form>
    <p class="mt-4 text-sm text-gray-400">
        This site is protected by reCAPTCHA Enterprise and the Google 
        <a href="https://policies.google.com/privacy" target="_blank" class="text-indigo-400 hover:text-indigo-300">Privacy Policy</a> and 
        <a href="https://policies.google.com/terms" target="_blank" class="text-indigo-400 hover:text-indigo-300">Terms of Service</a> apply.
    </p>
@endsection