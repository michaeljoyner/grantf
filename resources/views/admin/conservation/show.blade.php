@include('admin.writeups.show', [
    'deleteFormAction' => '/admin/conservation/'.$writeup->id,
    'editUrl' => '/admin/conservation/'. $writeup->id .'/edit'
])