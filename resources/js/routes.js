import Articles from "./components/Articles";
import ArticleDetails from "./components/ArticleDetails";
import ArticleTag from "./components/ArticleTag";
import Register from "./components/Register";
import Login from "./components/Login";

const routes = [
     { path: '/articles', name:'articles', component: Articles },
     { path: '/article/:slug', component: ArticleDetails },
     { path: '/articles/tag/:slug', component: ArticleTag },

     // Auth Routes

    {path: '/register', component: Register},
    {path: '/login', name: 'login', component: Login},
];

export default routes;



