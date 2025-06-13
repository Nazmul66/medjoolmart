@php
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

$rowId = md5($singleProduct->id . now());

$landingItem = [
    'rowId' => $rowId,
    'id'    => $singleProduct->id,
    'qty'   => 1,
    'name'  => $singleProduct->name,
    'price' => $singleProduct->selling_price,
    'weight'=> $singleProduct->weight ?? 0,
    'options' => [
        'size_id'         => $singleProduct->size_id ?? null,
        'size_name'       => $singleProduct->size_name ?? null,
        'size_price'      => $singleProduct->size_price ?? 0,
        'color_id'        => $singleProduct->color_id ?? null,
        'color_name'      => $singleProduct->color_name ?? null,
        'color_price'     => $singleProduct->color_price ?? 0,
        'variants_total'  => ($singleProduct->size_price ?? 0) + ($singleProduct->color_price ?? 0),
        'slug'            => $singleProduct->slug,
        'units'           => $singleProduct->units ?? 'pcs',
        'image'           => $singleProduct->thumb_image,
    ],
    'taxRate'      => 0,
    'discountRate' => 0,
    'instance'     => 'default',
];

// Merge both into one collection
$cartCollection = collect([
    $rowId => $landingItem,
]);

session()->put('landing_product', [
    'default' => $cartCollection
]);
@endphp