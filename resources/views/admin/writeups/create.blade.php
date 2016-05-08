<section class="gf-page-header">
    <h1>{{ $pageTitle }}</h1>
</section>
@include('admin.forms.writeup', [
    'formAction' => $formAction,
    'buttonText' => 'Create',
])