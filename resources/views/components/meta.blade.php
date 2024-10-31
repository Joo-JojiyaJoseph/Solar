@empty($metaData)
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="description">
    <meta name="keywords" content="keywords">
@else
    <title>{{ $metaData['title'] }}</title>
    <meta name="description" content="{{ $metaData['description'] }}">
    <meta name="keywords" content="{{ $metaData['keywords'] }}">

    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:title" content="{{ ($metaData['og_title'] != '') ? $metaData['og_title'] : $metaData['title']  }}" />
    <meta property="og:description" content="{{ ($metaData['og_description'] != '') ? $metaData['og_description'] : $metaData['description']  }}" />
    <meta property="og:image" content="{{ asset('/storage/'.$metaData['image']) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
@endempty