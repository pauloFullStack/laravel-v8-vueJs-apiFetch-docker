<template>
    <NavBar />
    <AppArticle />
</template>

<script>
import NavBar from "../components/Navbar";
import AppArticle from "../components/Article";

export default {
    name: "App",
    components: {
        NavBar,
        AppArticle,
    },
};
</script>
