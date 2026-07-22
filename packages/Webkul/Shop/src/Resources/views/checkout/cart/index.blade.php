<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.checkout.cart.index.cart')" />

    <meta name="keywords" content="@lang('shop::app.checkout.cart.index.cart')" />
@endPush

<x-shop::layouts :has-header="false" :has-feature="false" :has-footer="false">
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.checkout.cart.index.cart')
    </x-slot>

    {!! view_render_event('bagisto.shop.checkout.cart.header.before') !!}

    <!-- Page Header -->
    <div
        class="flex h-16 w-full justify-between border border-b border-l-0 border-r-0 border-t-0 px-[60px] max-1180:px-8">
        <!--
        This section will provide categories for the first, second, and third levels. If
        additional levels are required, users can customize them according to their needs.
    -->
        <!-- Left Nagivation Section -->
        <div class="flex items-center gap-x-10 max-[1180px]:gap-x-5">
            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.before') !!}

            <a href="{{ route('shop.home.index') }}" aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.bagisto')">
                <img src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}" width="120"
                    height="32" alt="{{ config('app.name') }}">
            </a>

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.after') !!}

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.before') !!}

            <!-- <v-desktop-category>
                    <div class="flex items-center gap-5">
                        <span
                            class="w-20 h-6 rounded shimmer"
                            role="presentation"></span>

                        <span
                            class="w-20 h-6 rounded shimmer"
                            role="presentation"></span>

                        <span
                            class="w-20 h-6 rounded shimmer"
                            role="presentation"></span>
                    </div>
                </v-desktop-category> -->

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.after') !!}
        </div>

        <!-- Right Nagivation Section -->
        <div class="flex items-center gap-x-6  max-[1100px]:gap-x-6 max-lg:gap-x-8">

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.search_bar.before') !!}

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.search_bar.after') !!}

            <!-- Right Navigation Links -->
            <div class="mt-1.5 gap-x-2 flex items-center max-[1100px]:gap-x-6 max-lg:gap-x-8">

                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.before') !!}

                <!-- Compare -->
                @if (core()->getConfigData('catalog.products.settings.compare_option'))
                    <a href="{{ route('shop.compare.index') }}" aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.compare')">
                        <span class="inline-block text-2xl cursor-pointer icon-compare" role="presentation"></span>
                    </a>
                @endif

                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.after') !!}


                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile.before') !!}

                <!-- user profile -->
                <x-shop::dropdown position="bottom-core()->getCurrentLocale()->direction==='ltr'?'right':'left' ">
                    <x-slot:toggle>
                        <span class="inline-block text-2xl cursor-pointer icon-users mr-2 mt-1.5" role="button"
                            aria-label="@lang('shop::app.components.layouts.header.desktop.bottom.profile')" tabindex="0"></span>
                    </x-slot>

                    <!-- Guest Dropdown -->
                    @guest('customer')
                        <x-slot:content>
                            <div class="grid gap-2.5">
                                <p class="text-xl font-dmserif">
                                    @lang('shop::app.components.layouts.header.desktop.bottom.welcome-guest')
                                </p>

                                <p class="text-sm">
                                    @lang('shop::app.components.layouts.header.desktop.bottom.dropdown-text')
                                </p>
                            </div>

                            <p class="w-full mt-3 border border-zinc-200"></p>

                            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.customers_action.before') !!}

                            <div class="flex gap-4 mt-6">
                                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.sign_in_button.before') !!}

                                <a href="{{ route('shop.customer.session.create') }}"
                                    class="block m-0 mx-auto text-base text-center primary-button w-max rounded-2xl px-7 max-md:rounded-lg ltr:ml-0 rtl:mr-0">
                                    @lang('shop::app.components.layouts.header.desktop.bottom.sign-in')
                                </a>

                                <a href="{{ route('shop.customers.register.index') }}"
                                    class="block m-0 mx-auto text-base text-center secondary-button w-max rounded-2xl px-7 max-md:rounded-lg max-md:py-3 ltr:ml-0 rtl:mr-0">
                                    @lang('shop::app.components.layouts.header.desktop.bottom.sign-up')
                                </a>

                                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.sign_up_button.after') !!}
                            </div>

                            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.customers_action.after') !!}
                        </x-slot>
                    @endguest

                    <!-- Customers Dropdown -->
                    @auth('customer')
                        <x-slot:content class="!p-0">
                            <div class="grid gap-2.5 p-5 pb-0">
                                <p class="text-xl font-dmserif" v-pre>
                                    @lang('shop::app.components.layouts.header.desktop.bottom.welcome')’
                                    {{ auth()->guard('customer')->user()->first_name }}
                                </p>

                                <p class="text-sm">
                                    @lang('shop::app.components.layouts.header.desktop.bottom.dropdown-text')
                                </p>
                            </div>

                            <p class="w-full mt-3 border border-zinc-200"></p>

                            <div class="mt-2.5 grid gap-1 pb-2.5">
                                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile_dropdown.links.before') !!}

                                <a class="px-5 py-2 text-base cursor-pointer hover:bg-gray-100"
                                    href="{{ route('shop.customers.account.profile.index') }}">
                                    @lang('shop::app.components.layouts.header.desktop.bottom.profile')
                                </a>

                                <a class="px-5 py-2 text-base cursor-pointer hover:bg-gray-100"
                                    href="{{ route('shop.customers.account.orders.index') }}">
                                    @lang('shop::app.components.layouts.header.desktop.bottom.orders')
                                </a>

                                @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                                    <a class="px-5 py-2 text-base cursor-pointer hover:bg-gray-100"
                                        href="{{ route('shop.customers.account.wishlist.index') }}">
                                        @lang('shop::app.components.layouts.header.desktop.bottom.wishlist')
                                    </a>
                                @endif

                                <!--Customers logout-->
                                @auth('customer')
                                    <x-shop::form method="DELETE" action="{{ route('shop.customer.session.destroy') }}"
                                        id="customerLogout" />

                                    <a class="px-5 py-2 text-base cursor-pointer hover:bg-gray-100"
                                        href="{{ route('shop.customer.session.destroy') }}"
                                        onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                                        @lang('shop::app.components.layouts.header.desktop.bottom.logout')
                                    </a>
                                @endauth

                                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile_dropdown.links.after') !!}
                            </div>
                        </x-slot>
                    @endauth
                </x-shop::dropdown>

                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.before') !!}

                <!-- Mini cart -->
                @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                    @include('shop::checkout.cart.mini-cart')
                @endif

                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.after') !!}


                <a href="https://nabu.co.in/"
                    class="cursor-pointer  leading-none text-muted-foreground  flex items-center gap-1 rounded-lg  px-3 py-2.5 text-sm text-[#323c42]">
                    <span role="button" tabindex="0"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-panel-left-close-icon lucide-panel-left-close">
                            <rect width="18" height="18" x="3" y="3" rx="2" />
                            <path d="M9 3v18" />
                            <path d="m16 15-3-3 3-3" />
                        </svg></span> Back to Nabu</a>

                {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile.after') !!}
            </div>
        </div>
    </div>

    {!! view_render_event('bagisto.shop.checkout.cart.header.after') !!}

    <div class="flex-auto">
        <div class="container px-[60px] max-lg:px-8 max-md:px-4">

            {!! view_render_event('bagisto.shop.checkout.cart.breadcrumbs.before') !!}

            <!-- Breadcrumbs -->
            {{-- @if (core()->getConfigData('general.general.breadcrumbs.shop'))
                <x-shop::breadcrumbs name="cart" />
                @endif --}}
            <div class="flex items-center justify-between mb-8 mt-8">
                <div class="flex items-center space-x-4">
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background h-10 px-4 py-2 text-gray-600 hover:text-gray-900 hover:bg-brand-logo-green rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4 mr-2" aria-hidden="true">
                            <path d="m12 19-7-7 7-7"></path>
                            <path d="M19 12H5"></path>
                        </svg>Back to Shop</button>
                    <h1 class="hidden md:block text-3xl font-bold text-neutral-900">Shopping Bag (3 items)</h1>
                </div>

                <button
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background h-10 px-4 py-2 text-red-600 hover:text-red-700 hover:bg-red-50"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-trash2 lucide-trash-2 w-4 h-4 mr-2"
                        aria-hidden="true">
                        <path d="M10 11v6"></path>
                        <path d="M14 11v6"></path>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                        <path d="M3 6h18"></path>
                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>Clear Bag</button>
            </div>


            {!! view_render_event('bagisto.shop.checkout.cart.breadcrumbs.after') !!}

            @php
                $errors = \Webkul\Checkout\Facades\Cart::getErrors();
            @endphp

            @if (!empty($errors) && $errors['error_code'] === 'MINIMUM_ORDER_AMOUNT')
                <div
                    class="mt-5 w-full gap-12 rounded-lg bg-[#FFF3CD] px-5 py-3 text-[#383D41] max-sm:px-3 max-sm:py-2 max-sm:text-sm">
                    {{ $errors['message'] }}: {{ $errors['amount'] }}
                </div>
            @endif

            <v-cart ref="vCart">
                <!-- Cart Shimmer Effect -->
                <x-shop::shimmer.checkout.cart :count="3" />
            </v-cart>
        </div>
    </div>

    @if (core()->getConfigData('sales.checkout.shopping_cart.cross_sell'))
        {!! view_render_event('bagisto.shop.checkout.cart.cross_sell_carousel.before') !!}

        <!-- Cross-sell Product Carousal -->
        <x-shop::products.carousel :title="trans('shop::app.checkout.cart.index.cross-sell.title')" :src="route('shop.api.checkout.cart.cross-sell.index')">
        </x-shop::products.carousel>

        {!! view_render_event('bagisto.shop.checkout.cart.cross_sell_carousel.after') !!}
    @endif

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-cart-template">
            <div>
                <!-- Cart Shimmer Effect -->
                <template v-if="isLoading">
                    <x-shop::shimmer.checkout.cart :count="3" />
                </template>

                <!-- Cart Information -->
                <template v-else>
                    <div
                        class="mt-8 flex flex-wrap gap-20 pb-8 max-1060:flex-col max-md:mt-0 max-md:gap-[30px] max-md:pb-0"
                        v-if="cart?.items?.length"
                    >
                        <div class="flex flex-1 flex-col gap-6 max-md:gap-5">

                            {!! view_render_event('bagisto.shop.checkout.cart.cart_mass_actions.before') !!}

                            <!-- Cart Mass Action Container -->
                            {{-- <div class="flex items-center justify-between border-b border-zinc-200 pb-2.5 max-md:py-2.5">
                                <div class="flex select-none items-center">
                                    <input
                                        type="checkbox"
                                        id="select-all"
                                        class="peer hidden"
                                        v-model="allSelected"
                                        @change="selectAll"
                                    >

                                    <label
                                        class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-navyBlue peer-checked:text-navyBlue"
                                        for="select-all"
                                        tabindex="0"
                                        aria-label="@lang('shop::app.checkout.cart.index.select-all')"
                                        aria-labelledby="select-all-label"
                                    >
                                    </label>

                                    <span
                                        class="text-xl max-sm:text-sm ltr:ml-2.5 rtl:mr-2.5"
                                        role="heading"
                                        aria-level="2"
                                    >
                                        @{{ "@lang('shop::app.checkout.cart.index.items-selected')".replace(':count', selectedItemsCount) }}
                                    </span>
                                </div>

                                <div v-if="selectedItemsCount">
                                    <span
                                        class="cursor-pointer text-base text-blue-700 max-sm:text-xs"
                                        role="button"
                                        tabindex="0"
                                        @click="removeSelectedItems"
                                    >
                                        @lang('shop::app.checkout.cart.index.remove')
                                    </span>

                                    @if (auth()->guard()->check())
                                        <span class="mx-2.5 border-r-2 border-zinc-200"></span>

                                        <span
                                            class="cursor-pointer text-base text-blue-700 max-sm:text-xs"
                                            role="button"
                                            tabindex="0"
                                            @click="moveToWishlistSelectedItems"
                                        >
                                            @lang('shop::app.checkout.cart.index.move-to-wishlist')
                                        </span>
                                    @endif
                                </div>
                            </div> --}}

                            {!! view_render_event('bagisto.shop.checkout.cart.cart_mass_actions.after') !!}

                            {!! view_render_event('bagisto.shop.checkout.cart.item.listing.before') !!}

                            <!-- Cart Item Listing Container -->
                            <div
                                class="grid gap-y-10 p-4 rounded-lg border text-card-foreground shadow-sm bg-white border-gray-200"
                                v-for="item in cart?.items"
                            >
                                <div class="flex justify-between gap-x-2.5  pb-5">
                                    <div class="flex gap-x-5">
                                        {{-- <div class="mt-11 select-none max-md:mt-9 max-sm:mt-7">
                                            <input
                                                type="checkbox"
                                                :id="'item_' + item.id"
                                                class="peer hidden"
                                                v-model="item.selected"
                                                @change="updateAllSelected"
                                            >

                                            <label
                                                class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-navyBlue peer-checked:text-navyBlue"
                                                :for="'item_' + item.id"
                                                tabindex="0"
                                                aria-label="@lang('shop::app.checkout.cart.index.select-cart-item')"
                                                aria-labelledby="select-item-label"
                                            ></label>
                                        </div> --}}

                                        {!! view_render_event('bagisto.shop.checkout.cart.item_image.before') !!}

                                        <!-- Cart Item Image -->
                                        <a :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', item.product_url_key)">
                                            <x-shop::media.images.lazy
                                                class="h-[110px] max-w-[110px] rounded-xl max-md:h-20 max-md:max-w-20"
                                                ::src="item.base_image.small_image_url"
                                                ::alt="item.name"
                                                width="110"
                                                height="110"
                                                ::key="item.id"
                                                ::index="item.id"
                                            />
                                        </a>

                                        {!! view_render_event('bagisto.shop.checkout.cart.item_image.after') !!}

                                        <!-- Cart Item Options Container -->
                                        <div class="grid place-content-start gap-y-2.5 max-md:gap-y-0">
                                            {!! view_render_event('bagisto.shop.checkout.cart.item_name.before') !!}

                                            <a :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', item.product_url_key)">
                                                <p class="text-base font-medium max-sm:text-sm">
                                                    @{{ item.name }}
                                                </p>
                                            </a>

                                            {!! view_render_event('bagisto.shop.checkout.cart.item_name.after') !!}

                                            {!! view_render_event('bagisto.shop.checkout.cart.item_details.before') !!}

                                            <!-- Cart Item Options Container -->
                                            <div
                                                class="grid select-none gap-x-2.5 gap-y-1.5"
                                                v-if="item.options.length"
                                            >
                                                <!-- Details Toggler -->
                                                <div class="">
                                                    <p
                                                        class="flex cursor-pointer items-center gap-x-4 text-base max-md:gap-x-1.5 max-sm:text-xs"
                                                        @click="item.option_show = ! item.option_show"
                                                    >
                                                        @lang('shop::app.checkout.cart.index.see-details')

                                                        <span
                                                            class="text-2xl max-md:text-lg"
                                                            :class="{'icon-arrow-up': item.option_show, 'icon-arrow-down': ! item.option_show}"
                                                        ></span>
                                                    </p>
                                                </div>

                                                <!-- Option Details -->
                                                <div
                                                    class="grid gap-2"
                                                    v-show="item.option_show"
                                                >
                                                    <template v-for="attribute in item.options">
                                                        <div class="max-md:grid max-md:gap-0.5">
                                                            <p class="text-sm font-medium text-zinc-500 max-md:font-normal max-sm:text-xs">
                                                                @{{ attribute.attribute_name + ':' }}
                                                            </p>

                                                            <p class="text-sm max-sm:text-xs">
                                                                <template v-if="attribute?.attribute_type === 'file'">
                                                                    <a
                                                                        :href="attribute.file_url"
                                                                        class="text-blue-700"
                                                                        target="_blank"
                                                                        :download="attribute.file_name"
                                                                    >
                                                                        @{{ attribute.file_name }}
                                                                    </a>
                                                                </template>

                                                                <template v-else>
                                                                    @{{ attribute.option_label }}
                                                                </template>
                                                            </p>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>

                                            {!! view_render_event('bagisto.shop.checkout.cart.item_details.after') !!}

                                            {!! view_render_event('bagisto.shop.checkout.cart.formatted_total.before') !!}

                                            <div class="md:hidden">
                                                <p class="text-lg font-semibold max-md:text-sm">
                                                    <template v-if="displayTax.prices == 'including_tax'">
                                                            @{{ item.formatted_total_incl_tax }}
                                                    </template>

                                                    <template v-else-if="displayTax.prices == 'both'">

                                                        @{{ item.formatted_total_incl_tax }}
                                                        <span class="text-xs font-normal">
                                                            @lang('shopTheme::app.checkout.cart.index.excl-tax')
                                                            <span class="font-medium">@{{ item.formatted_total }}</span>
                                                        </span>

                                                    </template>

                                                    <template v-else>
                                                            @{{ item.formatted_total }}
                                                    </template>
                                                </p>

                                                <span
                                                    class="cursor-pointer text-base text-blue-700 max-md:hidden"
                                                    role="button"
                                                    tabindex="0"
                                                    @click="removeItem(item.id)"
                                                >
                                                    @lang('shop::app.checkout.cart.index.remove')
                                                </span>
                                            </div>

                                            {!! view_render_event('bagisto.shop.checkout.cart.formatted_total.after') !!}

                                            {!! view_render_event('bagisto.shop.checkout.cart.quantity_changer.before') !!}

                                            <div class="flex items-center gap-2.5 max-md:mt-2.5">
                                                <x-shop::quantity-changer
                                                    v-if="item.can_change_qty"
                                                    ::key="'qty-' + item.id + '-' + refreshKey"
                                                    class="flex max-w-max items-center gap-x-2.5 rounded-[54px] border border-navyBlue px-3.5 py-1.5 max-md:gap-x-1.5 max-md:px-1 max-md:py-0.5"
                                                    name="quantity"
                                                    ::value="item?.quantity"
                                                    @change="setItemQuantity(item.id, $event)"
                                                />

                                                <!-- For Mobile view Remove Button -->
                                                <span
                                                    class="hidden cursor-pointer text-sm text-blue-700 max-md:block"
                                                    role="button"
                                                    tabindex="0"
                                                    @click="removeItem(item.id)"
                                                >
                                                    @lang('shop::app.checkout.cart.index.remove')
                                                </span>
                                            </div>

                                            {!! view_render_event('bagisto.shop.checkout.cart.quantity_changer.after') !!}
                                        </div>
                                    </div>

                                    <div class="text-right max-md:hidden">
                                        {!! view_render_event('bagisto.shop.checkout.cart.total.before') !!}

                                        <template v-if="displayTax.prices == 'including_tax'">
                                            <p class="text-lg font-semibold">
                                                @{{ item.formatted_total_incl_tax }}
                                            </p>
                                        </template>

                                        <template v-else-if="displayTax.prices == 'both'">
                                            <p class="flex flex-col text-lg font-semibold">
                                                @{{ item.formatted_total_incl_tax }}

                                                <span class="text-xs font-normal">
                                                    @lang('shop::app.checkout.cart.index.excl-tax')

                                                    <span class="font-medium">@{{ item.formatted_total }}</span>
                                                </span>
                                            </p>
                                        </template>

                                        <template v-else>
                                            <p class="text-lg font-semibold">
                                                @{{ item.formatted_total }}
                                            </p>
                                        </template>

                                        {!! view_render_event('bagisto.shop.checkout.cart.total.after') !!}

                                        {!! view_render_event('bagisto.shop.checkout.cart.remove_button.before') !!}

                                        <!-- Cart Item Remove Button -->
                                        <span
                                            class="cursor-pointer text-base text-blue-700"
                                            role="button"
                                            tabindex="0"
                                            @click="removeItem(item.id)"
                                        >
                                            @lang('shop::app.checkout.cart.index.remove')
                                        </span>

                                        {!! view_render_event('bagisto.shop.checkout.cart.remove_button.after') !!}
                                    </div>
                                </div>
                            </div>

                            {!! view_render_event('bagisto.shop.checkout.cart.item.listing.after') !!}

                            {!! view_render_event('bagisto.shop.checkout.cart.controls.before') !!}

                            <!-- Cart Item Actions -->
                            {{-- <div class="flex flex-wrap justify-end gap-8 max-md:justify-between max-md:gap-5">
                                {!! view_render_event('bagisto.shop.checkout.cart.continue_shopping.before') !!}

                                <a
                                    class="secondary-button max-h-14 rounded-2xl max-md:rounded-lg max-md:px-6 max-md:py-3 max-md:text-sm max-sm:py-2"
                                    href="{{ route('shop.home.index') }}"
                                >
                                    @lang('shop::app.checkout.cart.index.continue-shopping')
                                </a>

                                {!! view_render_event('bagisto.shop.checkout.cart.continue_shopping.after') !!}

                                {!! view_render_event('bagisto.shop.checkout.cart.update_cart.before') !!}

                                <x-shop::button
                                    class="secondary-button max-h-14 rounded-2xl max-md:rounded-lg max-md:px-6 max-md:py-3 max-md:text-sm max-sm:py-2"
                                    :title="trans('shop::app.checkout.cart.index.update-cart')"
                                    ::loading="isStoring"
                                    ::disabled="isStoring"
                                    @click="update()"
                                />

                                {!! view_render_event('bagisto.shop.checkout.cart.update_cart.after') !!}
                            </div> --}}

                            {!! view_render_event('bagisto.shop.checkout.cart.controls.after') !!}
                        </div>

                        {!! view_render_event('bagisto.shop.checkout.cart.summary.before') !!}

                        <!-- Cart Summary Blade File -->
                        @include('shop::checkout.cart.summary')

                        {!! view_render_event('bagisto.shop.checkout.cart.summary.after') !!}
                    </div>

                    <!-- Empty Cart Section -->
                    <div
                        class="m-auto grid w-full place-content-center items-center justify-items-center py-32 text-center"
                        v-else
                    >
                        <img
                            class="max-md:h-[100px] max-md:w-[100px]"
                            src="{{ bagisto_asset('images/thank-you.png') }}"
                            alt="@lang('shop::app.checkout.cart.index.empty-product')"
                            loading="lazy"
                            decoding="async"
                        />

                        <p
                            class="text-xl max-md:text-sm"
                            role="heading"
                        >
                            @lang('shop::app.checkout.cart.index.empty-product')
                        </p>
                    </div>
                </template>
            </div>
        </script>

        <script type="module">
            app.component("v-cart", {
                template: '#v-cart-template',

                data() {
                    return {
                        refreshKey: 0,

                        cart: [],

                        allSelected: false,

                        applied: {
                            quantity: {},
                        },

                        displayTax: {
                            prices: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_prices') }}",

                            subtotal: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_subtotal') }}",

                            shipping: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_shipping_amount') }}",
                        },

                        isLoading: true,

                        isStoring: false,
                    };
                },

                mounted() {
                    this.getCart();
                },

                computed: {
                    selectedItemsCount() {
                        return this.cart.items.filter(item => item.selected).length;
                    },
                },

                methods: {
                    getCart() {
                        this.$axios.get("{{ route('shop.api.checkout.cart.index') }}")
                            .then(response => {
                                this.cart = response.data.data;

                                this.isLoading = false;

                                if (response.data.message) {
                                    this.$emitter.emit('add-flash', {
                                        type: 'info',
                                        message: response.data.message
                                    });
                                }
                            })
                            .catch(error => {});
                    },

                    setCart(cart) {
                        this.cart = cart;
                    },

                    selectAll() {
                        for (let item of this.cart.items) {
                            item.selected = this.allSelected;
                        }
                    },

                    updateAllSelected() {
                        this.allSelected = this.cart.items.every(item => item.selected);
                    },

                    update() {
                        this.isStoring = true;

                        this.$axios.put("{{ route('shop.api.checkout.cart.update') }}", {
                                qty: this.applied.quantity
                            })
                            .then(response => {
                                if (response.data.data?.items !== undefined) {
                                    this.cart = response.data.data;

                                    this.$emitter.emit('add-flash', {
                                        type: 'success',
                                        message: response.data.message
                                    });
                                } else {
                                    /**
                                     * On failure the endpoint returns `{ data: { message } }`
                                     * — the server-thrown reason is inside `data`, not at
                                     * the top level. Read from `data.message` first so the
                                     * flash actually shows (e.g. "inventory-warning").
                                     */
                                    this.$emitter.emit('add-flash', {
                                        type: 'warning',
                                        message: response.data.data?.message || response.data.message,
                                    });
                                }

                                this.isStoring = false;

                                /**
                                 * Bump the key to force the quantity-changers to
                                 * remount from the server's current values. On a
                                 * rejected update the `value` prop stays the same,
                                 * so the component's internal watch never fires
                                 * and the locally-incremented count would stick
                                 * on screen otherwise.
                                 */
                                this.applied.quantity = {};
                                this.refreshKey++;
                            })
                            .catch(error => {
                                this.isStoring = false;

                                this.applied.quantity = {};
                                this.refreshKey++;
                            });
                    },

                    setItemQuantity(itemId, quantity) {
                        this.applied.quantity[itemId] = quantity;
                    },

                    removeItem(itemId) {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                this.$axios.post(
                                        "{{ route('shop.api.checkout.cart.destroy') }}", {
                                            '_method': 'DELETE',
                                            'cart_item_id': itemId,
                                        })
                                    .then(response => {
                                        this.cart = response.data.data;

                                        this.$emitter.emit('add-flash', {
                                            type: 'success',
                                            message: response.data.message
                                        });

                                    })
                                    .catch(error => {});
                            }
                        });
                    },

                    removeSelectedItems() {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                const selectedItemsIds = this.cart.items.flatMap(item => item.selected ?
                                    item.id : []);

                                this.$axios.post(
                                        "{{ route('shop.api.checkout.cart.destroy_selected') }}", {
                                            '_method': 'DELETE',
                                            'ids': selectedItemsIds,
                                        })
                                    .then(response => {
                                        this.cart = response.data.data;

                                        this.$emitter.emit('update-mini-cart', response.data.data);

                                        this.$emitter.emit('add-flash', {
                                            type: 'success',
                                            message: response.data.message
                                        });

                                    })
                                    .catch(error => {});
                            }
                        });
                    },

                    moveToWishlistSelectedItems() {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                const selectedItemsIds = this.cart.items.flatMap(item => item.selected ?
                                    item.id : []);

                                const selectedItemsQty = this.cart.items.filter(item => item.selected).map(
                                    item => this.applied.quantity[item.id] ?? item.quantity);

                                this.$axios.post(
                                        "{{ route('shop.api.checkout.cart.move_to_wishlist') }}", {
                                            'ids': selectedItemsIds,
                                            'qty': selectedItemsQty
                                        })
                                    .then(response => {
                                        this.cart = response.data.data;

                                        this.$emitter.emit('update-mini-cart', response.data.data);

                                        this.$emitter.emit('add-flash', {
                                            type: 'success',
                                            message: response.data.message
                                        });

                                    })
                                    .catch(error => {});
                            }
                        });
                    },
                }
            });
        </script>
    @endpushOnce
</x-shop::layouts>
