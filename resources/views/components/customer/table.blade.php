@php($no = 1)
@foreach($data as $d)
@php(
    $detail = json_decode($d->detail, TRUE)
)
<tr class="tr-user" data-id="{{ $d->id }}">
    <td>{{ $no }}</td>
    <td>{{ $d->username }}</td>
    <td>{{ $detail['email'] }}</td>
    <td>
        <div class="form-check form-switch">
            <input style="cursor: pointer;" class="form-check-input switchStatusUser" data-name="{{ $d->username }}" data-id="{{ $d->id }}" {{ ($d->status == 1) ? "checked" : "" }} type="checkbox" id="switchUser{{ $d->id }}">
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
                    <a class="dropdown-item btn-edit-user" data-id="{{ $d->id }}">Edit</a></li>
                <li>
                    <a class="dropdown-item btn-delete-user" data-name="{{ $d->username }}" data-id="{{ $d->id }}">Delete</a></li>
            </ul>
        </div>
    </td>
</tr>
@php($no++)
@endforeach