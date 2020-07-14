<div class="bg-white p-5 rounded-lg shadow shadow flex flex-col mt-3">
    <h3 class="font-normal text-xl py-5 -ml-5 border-l-4 border-blue-light pl-4 mb-4">
        Invite a User
    </h3>

    <form method="POST" action="{{ $project->path() .'/invitations' }}">
        @csrf

        <div class="mb-3">
            <input type="email" name="email" class="border border-grey rounded w-full py-2 px-3" placeholder="Email Adress">
        </div>
        

        <button class="py-2 px-5" type="submit" style=
        "background-color: #47cdff; 
        text-decoration: none;
        box-shadow: 0 2px 7px 0 #b0eaff; 
        border-radius: 5rem;
        color: white;
        font-size: 0.8rem;">Invite here</button>
    </form>
    
    @include('errors', ['bag' => 'invitations'])

</div>