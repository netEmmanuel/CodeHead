<template>
<div class="site__body">
    <div class="wrapper wrapper--flex">
        <main class="site__main">
            <section>
            <h3><strong> Latest Blog Posts</strong></h3>
            <hr>
        <form @submit.prevent="addblogpost">
        <div id="mc_embed_signup_scroll">
           
            <div class="subscribe-form__fields">
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model="blogpost.title">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Tag" v-model="blogpost.tag">
                </div>
                <div class="form-group">
                <textarea type="text" class="form-control" placeholder="Body" v-model="blogpost.body"></textarea>
                </div>
                <button type="submit" class="btn btn-light btn-block">Save Post</button>
            </div>
        </div>
    </form>
            <article class="excerpt m-b-md p-b-md">   
                <div v-for="blogpost in blogposts" v-bind:key="blogpost.id">
                    <header class="excerpt__header m-b-sm">
                    <h2 class="excerpt__title h2 no-ul">
                    <a href="#"> {{blogpost.title}}</a>
                    </h2>
                    <div class="post__meta">
                    <em>{{blogpost.tag}}</em>
                    </div>
                  </header> 
                  <div class="excerpt__body">
                  <p> {{blogpost.body}}</p> 
                  </div>
                  <button @click="deleteblogpost(blogpost.id)">Delete</button>
                  <button @click="editblogpost(blogpost)">Edit</button>
                </div>
            </article> 

            <!-- Begin MailChimp Signup Form -->
           
            <!--End mc_embed_signup-->

            <div class="pagination">
                <a class="pagination__older" href="#" @click="retriveposts(pagination.previous_page)" v-bind:class="[{disabled: !pagination.previous_page}]">
                &#8592; Previous Page
                </a>

                <span class="pagination__index">Page {{pagination.current_page}} of {{pagination.last_page}}</span>

                <a class="pagination__older" v-bind:class="[{disabled: !pagination.next_page}]" href="#"  @click="retriveposts(pagination.next_page)">
                Next Page &#8594;
                </a>
            </div>
            
            </section>
    </main>
    <aside class="site__sidebar">
        <div class="box p-a-sm m-b-md">
        <p class="m-b-sm"><strong>CodeHead</strong>. Articles on Software Development, Artificial Intelligence and Cryptocurrency . All articles are written by <a
        href="https://damilareemmanuel.com">Damilare Emmanuel</a>, Software Developer. </p>

        </div>
    </aside>
    
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
            },
            deleteblogpost(blogpostid){
                if(confirm("Are you Sure")){
                    fetch(`api/blogpost/${blogpostid}`,{
                        method:`delete`
                })
                .then(res=>res.json())
                .then(data=>{
                    alert('Blog post removed');
                    this.retriveposts();
                })
                .catch(err => console.log(err))
                    }
            },
            addblogpost(){
                if(this.edit === false){
                    fetch('api/blogpost',{
                        method:'post',
                        body:JSON.stringify(this.blogpost),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                    .then(res=>res.json())
                    .then(data=>{
                        this.blogpost.title ='';
                        this.blogpost.tag ='';
                        this.blogpost.body ='';
                        alert('Blog Post added');
                        this.retriveposts();
                    })
                    .catch(err => console.log(err));
                }else{

                    fetch('api/blogpost',{
                        method:'put',
                        body:JSON.stringify(this.blogpost),
                        headers:{
                            'content-type':'application/json'
                        }
                    })
                    .then(res=>res.json())
                    .then(data=>{
                        this.blogpost.title ='';
                        this.blogpost.tag ='';
                        this.blogpost.body ='';
                        alert('Blog Post Updated');
                        this.retriveposts();
                    })
                    .catch(err => console.log(err));
                }
            },
            editblogpost(blogpost){
                this.edit = true;
                this.blogpost.id = blogpost.id;
                this.blogpost_id = blogpost.id;
                this.blogpost.title = blogpost.title;
                this.blogpost.tag = blogpost.tag;
                this.blogpost.body = blogpost.body;

            }
        }
    }

</script>