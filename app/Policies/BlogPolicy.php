<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;

class BlogPolicy
{
    /**
     * Determine if the given user can view the blog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return bool
     */
    public function view(User $user, Blog $blog)
    {
        // An admin can view any blog; an author can only view their own blog
        return $user->id === $blog->user_id || $user->hasRole('admin');
    }

    /**
     * Determine if the given user can create blogs.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        // Only admins and authors can create blogs
        return $user->hasRole('author') || $user->hasRole('admin');
    }

    /**
     * Determine if the given user can update the blog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return bool
     */
    public function update(User $user, Blog $blog)
    {
        // An admin can update any blog; an author can only update their own blog
        return $user->id === $blog->user_id || $user->hasRole('admin');
    }

    /**
     * Determine if the given user can delete the blog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return bool
     */
    public function delete(User $user, Blog $blog)
    {
        // An admin can delete any blog; an author can only delete their own blog
        return $user->id === $blog->user_id || $user->hasRole('admin');
    }

    /**
     * Determine if the given user can export the blog.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return bool
     */
    public function export(User $user, Blog $blog)
    {
        // Only the author of the blog or an admin can export it
        return $user->id === $blog->user_id || $user->hasRole('admin');
    }
}
