<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment; // Import model Comment
use App\Models\News;    // Import model News
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, News $news)
    {
        if (Auth::check()) {
            $request->validate([
                'content' => 'required|string|max:1000',
            ]);
        } else {
            $request->validate([
                'guest_name' => 'required_without:user_id|string|max:255', // Required jika tidak ada user_id
                'guest_email' => 'required_without:user_id|nullable|email|max:255', // Required jika tidak ada user_id
                'content' => 'required|string|max:1000',
            ]);
        }
        // Sanitasi konten komentar untuk mencegah XSS
        // strip_tags() adalah sanitasi dasar. Untuk keamanan yang lebih robust, pertimbangkan HTML Purifier.
        $sanitizedContent = strip_tags($request->content, '<b><i><u><strong><em>');
        $comment = new Comment();
        $comment->news_id = $news->id;
        $comment->content = $sanitizedContent;
        if (Auth::check()) {
            $comment->user_id = Auth::id();
            $comment->guest_name = Auth::user()->name;
            $comment->guest_email = Auth::user()->email;
            $comment->is_approved = true;
        } else {
            $comment->guest_name = $request->guest_name;
            $comment->guest_email = $request->guest_email;
            $comment->is_approved = false;
        }

        $comment->save();
        if (Auth::check()) {
            return redirect()->back()->with('success_comment', 'Komentar Anda berhasil dikirim');
        } else {
            return redirect()->back()->with('success_comment', 'Komentar Anda berhasil dikirim dan akan muncul setelah disetujui admin.');
        }
    }
}
