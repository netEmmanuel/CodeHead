<template>
<div class="site__body">
    <div class="wrapper wrapper--flex">
        <main class="site__main">
            <div class="container">
            <section>
            <h1 class="sr-only">Latest Posts</h1>
                <h1>Blog Post</h1>
                <div v-for="blogpost in blogposts" v-bind:key="blogpost.id">
                    <h3>{{blogpost.title}}</h3>
                    <p> {{blogpost.body}}</p>
                    <h6>{{blogpost.tag}}</h6>
                </div>
                <li v-bind:class="[{disabled: !pagination.previous_page}]">
                    <a href="#" @click="retriveposts(pagination.previous_page)">Previous Page</a>
                </li>
                <li>
                    <a>Page {{pagination.current_page}} of {{pagination.last_page}}</a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page}]">
                    <a href="#" @click="retriveposts(pagination.next_page)">Next Page</a>
                </li>
            </section>
        </div>
    </main>
    
    </div>
</div>
    
    
</template>


<script>
    export default {
        data(){
            return{
                blogposts:[],
                blogpost:{
                    id: '',
                    title: '',
                    body: '',
                    tag: ''
                }, 
                blogpost_id: '',
                pagination: {},
                edit:false
            }
        },

        created(){
            this.retriveposts();
        },

        methods:{
            retriveposts(api_url){
                let pg= this;
                api_url= api_url || 'api/blogposts';
                fetch(api_url)
                .then(res => res.json())
                .then(res=>{
                    //console.log(res.data);
                    this.blogposts = res.data;
                    pg.paginate(res.links, res.meta);
                })
                .catch(err => console.log(err));
            },
            paginate(links, meta){
                let pagination={
                    current_page: meta.current_page,
                    last_page:meta.last_page,
                    previous_page:links.prev,
                    next_page:links.next
                }

                this.pagination=pagination
            }
        }
    }

</script>