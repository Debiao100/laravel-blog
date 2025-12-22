<script setup>
import { Head } from '@inertiajs/vue3';
import Layout from '../../Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

// 接收文章数据
const props = defineProps({
  article: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <Layout>
    <Head :title="article.title" />

    <div class="mb-6">
      <h2 class="font-semibold text-xl text-gray-800">文章详情</h2>
    </div>

    <!-- 文章内容 -->
    <div class="bg-white shadow-sm rounded-lg p-6">
      <h3 class="text-2xl font-bold mb-4">{{ article.title }}</h3>
      <div class="prose max-w-none mb-6 whitespace-pre-line">
        {{ article.content }}
      </div>

      <!-- 操作按钮 -->
      <div class="flex space-x-4">
        <Link 
          :href="`/articles/${article.id}/edit`" 
          class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded"
        >
          编辑
        </Link>
        <Link 
          href="/articles" 
          class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
        >
          返回列表
        </Link>
      </div>
    </div>
  </Layout>
</template>