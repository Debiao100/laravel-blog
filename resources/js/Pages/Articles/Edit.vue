<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Layout from '../../Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

// 接收后端传递的文章数据
const props = defineProps({
  article: {
    type: Object,
    required: true,
  },
});

// 初始化表单（填充现有数据）
const form = useForm({
  title: props.article.title,
  content: props.article.content,
});

// 提交更新
const submit = () => {
  form.put(`/articles/${props.article.id}`, {
    preserveScroll: true,
  });
};
</script>

<template>
  <Layout>
    <Head title="编辑文章" />

    <div class="mb-6">
      <h2 class="font-semibold text-xl text-gray-800">
        编辑文章：{{ article.title }}
      </h2>
    </div>

    <!-- 表单 -->
    <div class="bg-white shadow-sm rounded-lg p-6">
      <form @submit.prevent="submit">
        <!-- 标题 -->
        <div class="mb-4">
          <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
            文章标题
          </label>
          <input
            id="title"
            v-model="form.title"
            type="text"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{ 'border-red-500': form.errors.title }"
          />
          <p v-if="form.errors.title" class="text-red-500 text-xs mt-1">
            {{ form.errors.title }}
          </p>
        </div>

        <!-- 内容 -->
        <div class="mb-4">
          <label for="content" class="block text-gray-700 text-sm font-bold mb-2">
            文章内容
          </label>
          <textarea
            id="content"
            v-model="form.content"
            rows="10"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            :class="{ 'border-red-500': form.errors.content }"
          ></textarea>
          <p v-if="form.errors.content" class="text-red-500 text-xs mt-1">
            {{ form.errors.content }}
          </p>
        </div>

        <!-- 操作按钮 -->
        <div class="flex items-center justify-between">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          >
            <span v-if="form.processing">更新中...</span>
            <span v-else>更新文章</span>
          </button>
          <Link href="/articles" class="text-gray-600 hover:text-gray-900">
            取消
          </Link>
        </div>
      </form>
    </div>
  </Layout>
</template>