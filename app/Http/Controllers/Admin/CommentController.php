<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment; // Import model Comment
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of comments (for moderation).
     */
    public function index()
    {
        // Tampilkan komentar pending/disetujui, bisa difilter
        $comments = Comment::with('news', 'user') // Eager load berita dan user terkait
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Update the approval status of a comment.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $comment->is_approved = $request->boolean('is_approved');
        $comment->save();

        $status = $comment->is_approved ? 'disetujui' : 'ditolak/pending';
        return redirect()->back()->with('success', 'Komentar berhasil ' . $status . '.');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
