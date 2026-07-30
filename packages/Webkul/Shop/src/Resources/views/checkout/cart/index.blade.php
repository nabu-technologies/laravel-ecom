<!-- SEO Meta Content -->
@push('meta')
<meta name="description" content="@lang('shop::app.checkout.cart.index.cart')" />

<meta name="keywords" content="@lang('shop::app.checkout.cart.index.cart')" />
@endPush


<x-shop::layouts :has-header="true" :has-feature="false" :has-footer="false">
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.checkout.cart.index.cart')
        </x-slot>

        <div class="flex-auto ">
            <div class="container px-[60px] max-lg:px-8 max-md:px-4">

                {!! view_render_event('bagisto.shop.checkout.cart.breadcrumbs.before') !!}

                <!-- Breadcrumbs -->
                {{-- @if (core()->getConfigData('general.general.breadcrumbs.shop'))
                <x-shop::breadcrumbs name="cart" />
                @endif --}}



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

<div class="flex items-center justify-between pt-8">
    <div class="flex items-center space-x-4">
        <a href="{{ url('products') }}"
            class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background h-10 px-4 py-2 text-gray-600 hover:text-gray-900 hover:bg-brand-logo-green rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4 mr-2" aria-hidden="true">
                <path d="m12 19-7-7 7-7"></path>
                <path d="M19 12H5"></path>
            </svg>Back to Shop</a>
        <h1 class="hidden md:block text-3xl font-bold text-neutral-900">
            Shopping Bag <template v-if="cart?.items?.length">(@{{ cart.items_qty }} @{{ cart.items_qty > 1 ? 'items' : 'item' }})</template>
        </h1>
    </div>

    <button
        v-if="cart?.items?.length"
        @click="clearCart()"
        class="mb-8 mt-8 inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background h-10 px-4 py-2 text-red-600 hover:text-red-700 hover:bg-red-50">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="lucide lucide-trash2 lucide-trash-2 w-4 h-4 mr-2"
            aria-hidden="true">
            <path d="M10 11v6"></path>
            <path d="M14 11v6"></path>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
            <path d="M3 6h18"></path>
            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        </svg>Clear Bag
    </button>
</div>   <!-- ✅ DIV-1 close — ab sirf 2 divs the (DIV-1, DIV-2), dono balanced -->

<div v-if="cart?.items?.length" class="flex items-start gap-10">
    <div class="flex-1 flex flex-wrap gap-20 pb-8 max-1060:flex-col max-md:mt-0 max-md:gap-[30px] max-md:pb-0">
        <div class="flex flex-1 flex-col gap-6 max-md:gap-5">
            {!! view_render_event('bagisto.shop.checkout.cart.cart_mass_actions.before') !!}
            {!! view_render_event('bagisto.shop.checkout.cart.cart_mass_actions.after') !!}
            {!! view_render_event('bagisto.shop.checkout.cart.item.listing.before') !!}

            <div
                class="relative p-5 rounded-xl border border-gray-200 bg-white"
                v-for="item in cart?.items"
            >
                <div class="flex gap-x-5 relative">
                    <a :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', item.product_url_key)" class="shrink-0">
                        <x-shop::media.images.lazy
                            class="h-[120px] w-[120px] rounded-xl object-cover border border-gray-100"
                            ::src="item.base_image.small_image_url"
                            ::alt="item.name"
                            width="120"
                            height="120"
                            ::key="item.id"
                            ::index="item.id"
                        />
                    </a>

                    <div class="flex flex-1 flex-col justify-between min-h-[120px]">
                        <div>
                            <div class="flex justify-between items-start gap-x-4 pr-8">
                                <div>
                                    <a :href="'{{ route('shop.product_or_category.index', ':slug') }}'.replace(':slug', item.product_url_key)">
                                        <p class="text-lg font-bold text-neutral-900 hover:text-brand-green transition-colors">
                                            @{{ item.name }}
                                        </p>
                                    </a>
                                    <p class="text-sm text-gray-500 mt-0.5">
                                        @{{ item.options.length ? item.options.map(opt => opt.option_label).join(' - ') : item.sku }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-x-2 mt-2">
                                <span class="text-lg font-semibold text-emerald-500">
                                    @{{ item.formatted_price.replace('.00', '') }}
                                </span>
                                <span class="text-sm text-gray-400">
                                    x @{{ item.quantity }}
                                </span>
                                <span 
                                    v-if="parseFloat(item.discount_amount) > 0" 
                                    class="inline-flex items-center gap-x-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500 text-white ml-2"
                                >
                                    -@{{ ((parseFloat(item.discount_amount) / (parseFloat(item.price) * item.quantity)) * 100).toFixed(1) }}% OFF (@{{ item.formatted_discount_amount.replace('.00', '') }})
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center border-gray-100">
                            <div class="flex items-center gap-x-3">
                                <span class="text-sm font-medium text-gray-600"></span>
                                <x-shop::quantity-changer
                                    v-if="item.can_change_qty"
                                    ::key="'qty-' + item.id + '-' + refreshKey"
                                    class="flex max-w-max items-center gap-x-2.5 rounded-[54px] border border-gray-300 px-3.5 py-1 max-md:gap-x-1.5 max-md:px-1 max-md:py-0.5"
                                    name="quantity"
                                    ::value="item?.quantity"
                                    @change="setItemQuantity(item.id, $event)"
                                />
                            </div>

                            <div class="text-right">
                                <span class="text-xs text-gray-500 block">Item Total:</span>
                                <span class="text-lg font-bold text-emerald-500">
                                    @{{ item.formatted_total.replace('.00', '') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <button 
                        @click="removeItem(item.id)"
                        class="absolute top-0 right-0 p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                        title="Remove item"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                            <path d="M3 6h18"></path>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            <line x1="10" x2="10" y1="11" y2="17"></line>
                            <line x1="14" x2="14" y1="11" y2="17"></line>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {!! view_render_event('bagisto.shop.checkout.cart.item.listing.after') !!}
        {!! view_render_event('bagisto.shop.checkout.cart.controls.before') !!}
        {!! view_render_event('bagisto.shop.checkout.cart.controls.after') !!}
    </div>

    {!! view_render_event('bagisto.shop.checkout.cart.summary.before') !!}
    @include('shop::checkout.cart.summary')
    {!! view_render_event('bagisto.shop.checkout.cart.summary.after') !!}
</div>

<!-- Empty Cart Section -->
<div
    class="text-center py-20"
    v-else
>
    <!-- <img
        class="max-md:h-[100px] max-md:w-[100px]"
        src="{{ bagisto_asset('images/thank-you.png') }}"
        alt="@lang('shop::app.checkout.cart.index.empty-product')"
        loading="lazy"
        decoding="async"
    /> -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-24 h-24 text-gray-400 mx-auto mb-6" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
    <h2 class="text-2xl font-semibold text-gray-600 mb-4">Your bag is empty</h2>
    <p
        class="text-gray-500 mb-8"
        role="heading"
    >
        @lang('shop::app.checkout.cart.index.empty-product')
    </p>
     {!! view_render_event('bagisto.shop.checkout.cart.continue_shopping.before') !!}

        <a
            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 h-10 bg-brand-logo-green hover:bg-brand-green text-black px-8 py-3"
            href="{{ route('shop.home.index') }}">
            @lang('shop::app.checkout.cart.index.continue-shopping')
        </a>
        {!! view_render_event('bagisto.shop.checkout.cart.summary.proceed_to_checkout.after') !!}
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

                    clearCart() {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                const allItemsIds = this.cart.items.map(item => item.id);

                                this.$axios.post(
                                        "{{ route('shop.api.checkout.cart.destroy_selected') }}", {
                                            '_method': 'DELETE',
                                            'ids': allItemsIds,
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