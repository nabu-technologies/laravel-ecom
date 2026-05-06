{!! view_render_event('bagisto.shop.layout.footer.before') !!}

<!--
    The category repository is injected directly here because there is no way
    to retrieve it from the view composer, as this is an anonymous component.
-->
@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

<!--
    This code needs to be refactored to reduce the amount of PHP in the Blade
    template as much as possible.
-->
@php
    $channel = core()->getCurrentChannel();

    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'footer_links',
        'status'     => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]);
@endphp

{{-- <footer class="mt-9 bg-lightOrange max-sm:mt-10"> --}}
<footer class="mt-9 max-sm:mt-10 relative border-t border-neutral-200 bg-white overflow-hidden">
    <svg class="absolute pointer-events-none inset-0 w-full h-full opacity-[0.16]" aria-hidden="true"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><circle cx="1" cy="1" r="1" fill="currentColor"></circle></pattern><linearGradient id="pulse" x1="0" x2="1" y1="0" y2="0"><stop offset="0%" stop-color="#42D96B" stop-opacity="0.4"></stop><stop offset="100%" stop-color="#42D96B" stop-opacity="0"></stop></linearGradient></defs><rect width="100%" height="100%" fill="url(#grid)" class="text-brand-green/20"></rect><g><circle r="120" cx="-60" cy="100" fill="none" stroke="url(#pulse)" stroke-width="2"><animate attributeName="r" from="80" to="160" dur="8s" repeatCount="indefinite"></animate><animate attributeName="opacity" values="0.4;0;0.4" dur="8s" repeatCount="indefinite"></animate></circle><circle r="160" cx="100%" cy="80" fill="none" stroke="url(#pulse)" stroke-width="2"><animate attributeName="r" from="100" to="200" dur="10s" repeatCount="indefinite"></animate><animate attributeName="opacity" values="0.4;0;0.4" dur="10s" repeatCount="indefinite"></animate></circle></g><g opacity="0.25"><g><line x1="-200" y1="40" x2="2000" y2="40" stroke="#42D96B" stroke-width="1" stroke-opacity="0.4"></line><line x1="-400" y1="120" x2="2000" y2="120" stroke="#42D96B" stroke-width="1" stroke-opacity="0.3"></line><line x1="-300" y1="200" x2="2000" y2="200" stroke="#42D96B" stroke-width="1" stroke-opacity="0.25"></line><animateTransform attributeName="transform" type="translate" from="0 0" to="120 0" dur="14s" repeatCount="indefinite"></animateTransform></g></g></svg>

    <div class="flex justify-between gap-x-6 gap-y-8 p-[60px] max-1060:flex-col-reverse max-md:gap-5 max-md:p-8 max-sm:px-4 max-sm:py-5">
        <!-- For Desktop View -->
        <div>
            <div class="flex items-center">
                <img alt="Nabu" class="h-10 w-auto rounded-lg mr-3" src="{{ core()->getCurrentChannel()->logo_url }}">
            </div>
            <div class="mt-4 pl-[12px] space-y-2 text-sm text-neutral-600">
                <div class="flex flex-col space-y-1">
                    <span>725, 7th Floor, SRS Tower</span>
                    <span>Sector-31, Faridabad, Haryana - 121003</span>
                </div>
                <div class="flex flex-col space-y-1">
                    <a href="tel:+919560012319" class="hover:text-neutral-900">+91 9560012319</a>
                </div>
                <div class="flex flex-col space-y-1">
                    <a href="mailto:care@nabu.co.in" class="hover:text-neutral-900">care@nabu.co.in</a>
                </div>
            </div>
        </div>

        <div
            class="flex flex-wrap items-start gap-24 max-1180:gap-24"
            v-pre
        >
            @if ($customization?->options)
                @foreach ($customization->options as $footerLinkSection)
                    <ul class="grid gap-5 text-sm">
                        @php
                            usort($footerLinkSection, function ($a, $b) {
                                return $a['sort_order'] - $b['sort_order'];
                            });
                        @endphp

                        @foreach ($footerLinkSection as $link)
                            <li>
                                <a href="{{ $link['url'] }}">
                                    {{ $link['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @endif
        </div>

        <!-- For Mobile view -->
        {{-- <x-shop::accordion
            :is-active="false"
            class="hidden !w-full rounded-xl !border-2 !border-[#e9decc] max-1060:block max-sm:rounded-lg"
        >
            <x-slot:header class="rounded-t-lg bg-[#F1EADF] font-medium max-md:p-2.5 max-sm:px-3 max-sm:py-2 max-sm:text-sm">
                @lang('shop::app.components.layouts.footer.footer-content')
            </x-slot>

            <x-slot:content class="flex justify-between !bg-transparent !p-4">
                @if ($customization?->options)
                    @foreach ($customization->options as $footerLinkSection)
                        <ul
                            class="grid gap-5 text-sm"
                            v-pre
                        >
                            @php
                                usort($footerLinkSection, function ($a, $b) {
                                    return $a['sort_order'] - $b['sort_order'];
                                });
                            @endphp

                            @foreach ($footerLinkSection as $link)
                                <li>
                                    <a
                                        href="{{ $link['url'] }}"
                                        class="text-sm font-medium max-sm:text-xs"
                                    >
                                        {{ $link['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif
            </x-slot>
        </x-shop::accordion> --}}

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.before') !!}

        <!-- News Letter subscription -->
        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
            <div class="grid gap-2.5">
                <p
                    class="max-w-[288px] text-3xl italic leading-[45px] text-navyBlue max-md:text-2xl max-sm:text-lg"
                    role="heading"
                    aria-level="2"
                >
                    @lang('shop::app.components.layouts.footer.newsletter-text')
                </p>

                <p class="text-xs">
                    @lang('shop::app.components.layouts.footer.subscribe-stay-touch')
                </p>

                <div>
                    <x-shop::form
                        :action="route('shop.subscription.store')"
                        class="mt-2.5 rounded max-sm:mt-0"
                    >
                        <div class="relative w-full">
                            <x-shop::form.control-group.control
                                type="email"
                                class="block w-[420px] max-w-full rounded-xl border-2 border-[#e9decc] bg-[#F1EADF] px-5 py-4 text-base max-1060:w-full max-md:p-3.5 max-sm:mb-0 max-sm:rounded-lg max-sm:border-2 max-sm:p-2 max-sm:text-sm"
                                name="email"
                                rules="required|email"
                                label="Email"
                                :aria-label="trans('shop::app.components.layouts.footer.email')"
                                placeholder="email@example.com"
                            />
    
                            <x-shop::form.control-group.error control-name="email" />
    
                            <button
                                type="submit"
                                class="absolute top-1.5 flex w-max items-center rounded-xl bg-white px-7 py-2.5 font-medium hover:bg-zinc-100 ltr:right-2 rtl:left-2 max-md:top-1 max-md:px-5 max-md:text-xs max-sm:mt-0 max-sm:rounded-lg max-sm:px-4 max-sm:py-2"
                            >
                                @lang('shop::app.components.layouts.footer.subscribe')
                            </button>
                        </div>
                    </x-shop::form>
                </div>
            </div>
        @endif

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.after') !!}
    </div>

    <div class="flex justify-between bg-white px-[60px] py-3.5 max-md:justify-center max-sm:px-5">
        {!! view_render_event('bagisto.shop.layout.footer.footer_text.before') !!}

        <p class="text-sm text-zinc-600 max-md:text-center">
            @if (core()->getConfigData('general.content.footer.copyright_content'))
                {!! core()->getConfigData('general.content.footer.copyright_content') !!}
            @else
                @lang('shop::app.components.layouts.footer.footer-text', ['current_year'=> date('Y') ])
            @endif
        </p>

        {!! view_render_event('bagisto.shop.layout.footer.footer_text.after') !!}
    </div>
</footer>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}
