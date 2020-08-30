<div class="bg-white p-5 rounded-lg shadow shadow flex flex-col mt-3">
    <h3 class="font-normal text-xl py-5 -ml-5 border-l-4 border-red-light pl-4 mb-4">
        Povabi Uporabnika
    </h3>

    <form method="POST" action="{{ $project->path() .'/invitations' }}">
        @csrf

        <div class="mb-3">
            <input type="email" name="email" class="border border-grey rounded w-full py-2 px-3" placeholder="E-naslov">
        </div>
        

        <button class="py-2 px-5" type="submit" style=
        "background-color: #ed8780; 
        text-decoration: none;
        box-shadow: 0 2px 7px 0 #ed8500; 
        border-radius: 5rem;
        color: white;
        font-size: 0.8rem;">Povabi</button>
    </form>
    
    @include('errors', ['bag' => 'invitations'])

</div>