@push('title', 'Inbox')

<section class="relative size-full items-center px-3 sm:px-6 mt-6 p-6 shadow-md rounded-lg min-h-[550px] bg-white ">
    <div class="absolute overflow-y-hidden shrink-0 inset-y-0 left-0 w-1/3 shadow-md rounded-lg min-h-[320px] border">
        <livewire:chat.inbox/>
    </div>
    <div class="hidden absolute inset-y-0 right-0 overflow-y-auto md:grid min-h-[500px] w-2/3 h-full border rounded-lg" style="contain:content">
        <div class="flex flex-col gap-3 m-auto text-center justify-center">
            <h4 class="font-medium text-lg">Choose a conversation to start chatting</h4>
        </div>
    </div>
</section>