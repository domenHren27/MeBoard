  
<template>
    <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Začnimo nekaj novega</h1>

        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Naslov</label>

                        <input
                            type="text"
                            id="title"
                            class="border p-2 text-xs block w-full rounded"
                            :class="form.errors.title ? 'border-red' : 'border-muted-light'"
                            v-model="form.title">

                        <span class="text-xs italic text-red" v-if="form.errors.title" v-text="form.errors.title[0]"></span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Opis</label>

                        <textarea
                            id="description"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            :class="form.errors.description ? 'border-red' : 'border-muted-light'"
                            rows="7"
                            v-model="form.description"></textarea>

                        <span class="text-xs italic text-red" v-if="form.errors.description" v-text="form.errors.description[0]"></span>
                    </div>
                </div>

                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="text-sm block mb-2">Potrebuješ naloge ?</label>
                        <input
                            type="text"
                            class="border border-muted-light mb-2 p-2 text-xs block w-full rounded"
                            placeholder="Task 1"
                            v-for="task in form.tasks"
                            v-model="task.body">
                    </div>

                    <button type="button" class="inline-flex items-center text-xs"  @click="addTask">
                        

                        <span>Dodaj novo polje naloge</span>
                    </button>
                </div>
            </div>

            <footer class="flex justify-end">
                <button type="button" style="background-color: #ed8780;
                        text-decoration: none;
                        box-shadow: rgb(176, 234, 255) 0px 2px 7px 0px;
                        border-radius: 5rem;
                        color: white;
                        font-size: 0.8rem;" class="px-5 py-2 button is-outlined mr-4" @click="$modal.hide('new-project')">Prekini</button>
                <button class="button px-5 py-2" 
                style="background-color: #ed8780;
                        text-decoration: none;
                        box-shadow: rgb(176, 234, 255) 0px 2px 7px 0px;
                        border-radius: 5rem;
                        color: white;
                        font-size: 0.8rem;">
                Ustari projekt</button>
            </footer>
        </form>
    </modal>
</template>

<script>

    import MeboardForm from './MeboardForm';

    export default {
        data() {
            return {
                form: new MeboardForm({
                    title: '',
                    description: '',
                    tasks: [
                        { body: ''},
                    ]

                })

            };
        },
        methods: {
            addTask() {
                this.form.tasks.push({ body: '' });
            },
            async submit() {

                if (! this.form.tasks[0].body) {
                    delete this.form.originalData.tasks;
                }
                this.form.submit('/projects')
                    .then(response => location = response.data.message);
            }


        }
    }
</script>