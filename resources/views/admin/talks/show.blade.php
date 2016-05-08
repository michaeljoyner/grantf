@include('admin.writeups.show', [
    'deleteFormAction' => '/admin/speaking/'.$writeup->id,
    'editUrl' => '/admin/speaking/'. $writeup->id .'/edit'
])