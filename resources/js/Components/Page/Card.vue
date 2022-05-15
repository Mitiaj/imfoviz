<template xmlns:slot="http://www.w3.org/1999/html">
    <div class="py-5">
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-2">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                        <slot name="header"/>
                    </h3>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <slot/>
                </div>
            </div>
        </div>
    </div>
</template>
