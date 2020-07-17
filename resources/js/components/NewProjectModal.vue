<template>
    <modal name="new-project" classes="p-4 bg-blue rounded-lg p-10" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl" >Let's start something new</h1>
        
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class=" mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input 
                            type="text" 
                            id="title" 
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            :class="errors.title ? 'border-red' : 'border-muted-light'" 
                            v-model="form.title"
                        >
                        <span class="text-xs text-italic text-red" v-if="errors.title" v-text="errors.title[0]"></span>
                    </div>
                

                
                    <div class=" mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>
                        <textarea id="description" class="border border-muted-light p-2 text-xs block w-full rounded" rows="7" v-model="form.description"></textarea>
                        <span class="text-xs text-italic text-red" v-if="errors.description" v-text="errors.description[0]"></span>
                    </div>
                </div>
                
            
                <div class="flex-1 ml-4">
                    <div class=" mb-4">
                        <label class="text-sm block mb-2">Need Some Tasks?</label>
                        <input 
                            type = "text" 
                            class="border border-muted-light p-2 text-xs block w-full rounded mb-2" 
                            placeholder="Task-1" 
                            v-for="task in form.tasks"
                            v-model="task.body"
                        >
                    </div>

                    <button  type= "button" @click= "addTask"class="border p-2 rounded-full bg-blue-light shadow">
                        <span class="text-sm text-grey-light">Add New Tsk Fieald</span>
                    </button>
                </div>
            </div>
            <footer class="flex justify-end">
                <button type="button" @click="$modal.hide('new-project')" style="
                background-color: #47cdff; 
                text-decoration: none;
                box-shadow: 0 2px 7px 0 #b0eaff; 
                border-radius: 5rem;
                color: white;
                font-size: 0.8rem;" class="py-2 px-5 mr-2">Cancel</button>
                <button style="
                background-color: #47cdff; 
                text-decoration: none;
                box-shadow: 0 2px 7px 0 #b0eaff; 
                border-radius: 5rem;
                color: white;
                font-size: 0.8rem;" type="submit" class="py-2 px-5">Create Project</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    export default {

        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    tasks: [
                    { body: ''},
                    ]
                },

                errors: {

                }
                
            };
        },
        methods: {
            addTask() {
                this.form.tasks.push({ body:''})
            },
            async submit() {
                try {
                    let response = await axios.post('/projects', this.form);

                    console.log(response.data.message)

                    location = response.data.message;
                }
                catch (error) {
                    this.errors=(error.response.data.errors);
                }
            }
        }
    }
</script>