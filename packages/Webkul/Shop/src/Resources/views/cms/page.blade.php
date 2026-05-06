<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="{{ $page->meta_title }}" />

    <meta name="description" content="{{ $page->meta_description }}" />

    <meta name="keywords" content="{{ $page->meta_keywords }}" />
@endPush

<!-- Page Layout -->
<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        {{ $page->meta_title }}
    </x-slot>

    <!-- Page Content -->
    <div class="container mt-8 px-[60px] max-lg:px-8">
        <cms-page-content></cms-page-content>
    </div>
    
    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="cms-page-content-template"
        >
            <div ref="cmsPageContentNoTw"></div>
        </script>
    
        <script type="module">
            app.component('cms-page-content', {
                template: '#cms-page-content-template',
    
                data() {
                    return {
                        html: `{!! $page->html_content !!}`,
                    }
                },
    
                mounted() {
                    const shadow = this.$refs.cmsPageContentNoTw.attachShadow({ mode: "open" });
                    shadow.innerHTML = this.html;
                },
            });
        </script>
    @endPushOnce
</x-shop::layouts>



