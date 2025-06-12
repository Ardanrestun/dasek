<div class="pointer-events-auto z-50 cursor-pointer select-none overflow-hidden rounded-md bg-white p-5 shadow hover:bg-gray-50 ltr:border-l-8 rtl:border-r-8"
    x-bind:class="{
        'border-blue-700': toast.type === 'info',
        'border-green-700': toast.type === 'success',
        'border-yellow-700': toast.type === 'warning',
        'border-red-700': toast.type === 'danger'
    }">
    <div class="flex items-center justify-between space-x-5 rtl:space-x-reverse">
        <div class="flex-1 ltr:mr-2 rtl:ml-2">
            <div class="font-large mb-1 text-lg font-black uppercase tracking-widest text-gray-900" x-html="toast.title"
                x-show="toast.title !== undefined"></div>

            <div class="text-gray-900" x-show="toast.message !== undefined" x-html="toast.message">
            </div>
        </div>

        @include('tall-toasts::includes.icon')
    </div>
</div>
