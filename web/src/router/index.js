import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import MapTest from '@/components/MapTest.vue'
import Page404 from '@/views/Page_404.vue'
import Guess from "@/components/Guess.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/map',
      name: 'map',
      component: MapTest
    },
    {
      path: '/guess',
      name: 'guess',
      component: Guess

    },
    {
      path: '/:pathMatch(.*)',
      name: 'page404',
      component: Page404
    }
  ]
})

export default router
