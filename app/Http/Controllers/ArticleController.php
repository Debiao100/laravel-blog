<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 文章列表
    public function index()
    {
        // 方案1：强制获取用户模型实例（推荐）
        $user = User::findOrFail(Auth::id()); // 通过 Auth::id() 取用户ID，再查模型
        $articles = $user->articles()->latest()->paginate(10);
        return Inertia::render('Articles/Index', [
            'articles' => $articles,
            'success' => session('success'), // 传递提示信息
        ]);
    }

    // 新建文章页面
    public function create()
    {
        return Inertia::render('Articles/Create');
    }

    // 保存文章
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // 改用 Auth::id() 关联用户，避免直接依赖 Auth::user() 实例
        // Article::create([
        //     ...$validated,
        //     'user_id' => Auth::id(), // 直接取用户ID，手动赋值外键
        // ]);

        // 核心修改：手动添加 user_id 字段，值为当前登录用户ID
    $validated['user_id'] = Auth::id(); 
    // 直接创建文章，不再依赖关联方法
    Article::create($validated);

        return redirect()->route('articles.index')->with('success', '文章创建成功！');
    }

    // 文章详情
    public function show(Article $article)
    {
        $this->authorize('view', $article);
        return Inertia::render('Articles/Show', [
            'article' => $article,
        ]);
    }

    // 编辑文章页面
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return Inertia::render('Articles/Edit', [
            'article' => $article,
        ]);
    }

    // 更新文章
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', '文章更新成功！');
    }

    // 删除文章
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();

        return redirect()->route('articles.index')->with('success', '文章删除成功！');
    }
}