<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    // 查看权限：仅作者可看
    public function view(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    // 创建权限：登录用户均可创建
    public function create(User $user): bool
    {
        return true;
    }

    // 更新权限：仅作者可更
    public function update(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    // 删除权限：仅作者可删
    public function delete(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }
}