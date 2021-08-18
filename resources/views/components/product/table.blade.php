@php($no = $page + 1)
@foreach($data as $d)
<tr class="tr-user" data-id="{{ $d->id }}">
    <td>{{ $no }}</td>
    <td>{{ $d->product }}</td>
    <td>{{ $d->price }}</td>
    <td>{{ ($d->stock != "") ? "$d->stock " . "gr" : "-" }}</td>
    <td>
        <div class="form-check form-switch">
            <input style="cursor: pointer;" class="form-check-input switchStatusProduct" data-name="{{ $d->product }}" data-id="{{ $d->id }}" {{ ($d->status == 1) ? "checked" : "" }} type="checkbox" id="switchProduct{{ $d->id }}">
            <input type="hidden" class="current-page-input">
            <label class="form-check-label" for="switchUser{{ $d->id }}"></label>
        </div>
    </td>
    <td class="text-center">
        <div class="dropdown dropstart">
            <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v text-secondary"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item btn-edit-product" data-name="{{ $d->product }}" data-id="{{ $d->id }}">Edit</a></li>
                <li>
                    <a class="dropdown-item btn-delete-product" data-name="{{ $d->product }}" data-id="{{ $d->id }}">Delete</a></li>
            </ul>
        </div>
    </td>
</tr>
@php($no++)
@endforeach