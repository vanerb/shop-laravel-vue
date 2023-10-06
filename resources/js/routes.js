//Rutas generales
const Home = ()=> import('./components/Home.vue');
const Contact = ()=> import('./components/Contact.vue');
const Shop = ()=> import('./components/Shop.vue');
const AdminPanel = ()=> import('./components/AdminPanel.vue');

//Rutas especificas productos

const ShowProduct = ()=> import('./components/products/Show.vue');
const EditProduct = ()=> import('./components/products/Edit.vue');
const AddProduct = ()=> import('./components/products/Add.vue');
const ShowProductId = ()=> import('./components/ShowItem.vue');

//Rutas especificas categorias

const ShowCategory = ()=> import('./components/category/Show.vue');
const EditCategory = ()=> import('./components/category/Edit.vue');
const AddCategory = ()=> import('./components/category/Add.vue');

//Rutas Login

const Login = ()=> import('./components/user/Login.vue');
const Register = ()=> import('./components/user/Register.vue');
const Logout = ()=> import('./components/user/Logout.vue');

//Rutas usuario

const ShowUser = ()=>import('./components/user/Show.vue');
const EditUser = ()=>import('./components/user/Edit.vue');


//Rutas cesta

const ShowBasket = ()=>import('./components/basket/Show.vue');

//Establecer rutas

export const routes = [
    {
        name:'home',
        path: '/',
        component: Home
    },
    {
        name:'contact',
        path: '/contact',
        component: Contact
    },
    {
        name:'shop',
        path: '/shop',
        component: Shop
    },
    {
        name:'contact',
        path: '/contact',
        component: Contact
    },
    {
        name:'showproduct',
        path: '/showproduct',
        component: ShowProduct
    },
    {
        name:'addproduct',
        path: '/addproduct',
        component: AddProduct
    },
    {
        name:'editproduct',
        path: '/editproduct/:id',
        component: EditProduct
    },
    {
        name:'showcategory',
        path: '/showcategory',
        component: ShowCategory
    },
    {
        name:'addcategory',
        path: '/addcategory',
        component: AddCategory
    },
    {
        name:'editcategory',
        path: '/editcategory/:id',
        component: EditCategory
    },
    {
        name:'login',
        path: '/login',
        component: Login
     },
     {
        name:'register',
        path: '/register',
        component: Register
     },
     {
        name:'logout',
        path: '/logout',
        component: Logout
     },
     {
        name:'adminpanel',
        path: '/adminpanel',
        component: AdminPanel
     },
     {
        name:'showuser',
        path: '/showuser',
        component: ShowUser
     },
     {
        name:'edituser',
        path: '/edituser/:id',
        component: EditUser
     },
     {
        name:'showbasket',
        path: '/showbasket',
        component: ShowBasket
     },
     {
        name:'showproductid',
        path: '/showproductid/:id',
        component: ShowProductId
     },



]