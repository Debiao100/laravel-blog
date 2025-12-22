<script setup>
import { Head } from '@inertiajs/vue3';
import Layout from '../../Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

// 接收后端传递的 props
const props = defineProps({
  articles: {
    type: Object,
    required: true,
  },
  success: {
    type: String,
    required: false,
  },
});
</script>

<template>
  <Layout>
    <Head title="我的文章列表" />

    <!-- 页面头部 -->
    <div class="mb-6 flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800">我的文章列表</h2>
      <Link 
        href="/articles/create" 
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >
        新建文章
      </Link>
    </div>

    <!-- 成功提示 -->
    <div v-if="success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
      {{ success }}
    </div>

    <!-- 文章列表 -->
    <div v-if="articles.data.length === 0" class="bg-white p-6 rounded-lg shadow">
      暂无文章，快去创建第一篇吧！
    </div>

    <div v-else class="bg-white shadow-sm rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">标题</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">创建时间</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="article in articles.data" :key="article.id">
            <td class="px-6 py-4 whitespace-nowrap">
              <Link :href="`/articles/${article.id}`" class="text-blue-600 hover:text-blue-900">
                {{ article.title }}
              </Link>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ new Date(article.created_at).toLocaleString('zh-CN') }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <Link :href="`/articles/${article.id}/edit`" class="text-indigo-600 hover:text-indigo-900 mr-4">
                编辑
              </Link>
              <button 
                @click="confirmDelete(article.id)"
                class="text-red-600 hover:text-red-900"
              >
                删除
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- 分页 -->
      <div class="px-6 py-4 border-t border-gray-200 bg-white">
        <div class="flex justify-between">
          <Link 
            v-if="articles.links.prev" 
            :href="articles.links.prev" 
            class="text-sm text-gray-700 hover:text-blue-600"
          >
            « 上一页
          </Link>
          <Link 
            v-if="articles.links.next" 
            :href="articles.links.next" 
            class="text-sm text-gray-700 hover:text-blue-600"
          >
            下一页 »
          </Link>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
export default {
  methods: {
    confirmDelete(id) {
      if (confirm('确定要删除这篇文章吗？')) {
        this.$inertia.delete(`/articles/${id}`, {
          preserveScroll: true,
          onSuccess: () => {
            // 刷新页面以更新列表
            this.$inertia.reload();
          },
        });
      }
    },
  },
};
</script>