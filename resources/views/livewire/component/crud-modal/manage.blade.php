<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Manage {{ $type }} {{ $name }}
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form>
        <x-slot name="content">
            <div class="access-radio">
                <h6>General Access</h6>
                <div class="custom-control custom-radio">
                    <input type="radio" wire:model="contentAccessType" id="is-private1" name="folderAccessType"
                        class="custom-control-input" value="public">
                    <label class="custom-control-label" for="is-private1">Public</label>
                    <p>This project would be available to anyone who has the link</p>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" wire:model="contentAccessType" id="is-private2" class="custom-control-input"
                        value="private" name="folderAccessType">
                    <label class="custom-control-label" for="is-private2">Privates</label>
                    <p>Only people with access can open with the link</p>
                </div>
            </div>
            @if($contentAccessType == "private")
            <div class="form-group" id="formPrivate">
                <h6>Invite User</h6>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <select class="form-control" name="invitedUser" id="invitedUser" wire:model="invitedUsers">
                            <option value="" hidden></option>
                            @foreach($users as $user)

                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <select class="form-control bg-primary text-white" wire:model="invitedAccess"
                                name="accessType" id="accessType">
                                @foreach($permission as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h6>Generate Password</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" aria-label="">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button">Generate</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($userHaveAccess)
            <div class="form-group">
                <h6>User With Access</h6>
                @if ($userHaveAccess)
                @foreach ( $userHaveAccess as $user ) {{-- <p>{{ }}</p> --}}
                <div class="border rounded p-1 pl-2 pr-2 d-flex justify-content-between mb-1" style="height: 40px">
                    <div class="d-flex justify-align-center">
                        <p class="m-0 mr-2 my-auto">🔘</p>
                        <p class="m-0 mr-2 my-auto">{{$user->user->name }}</p>
                    </div>
                    <div class="d-flex justify-align-center">
                        <div class="input-group-append">
                            <select class="form-control bg-primary text-white">
                                @foreach($permission as $data)
                                <option value="{{ $data->id }}" {{ $data->id == $user->permission_id? "selected":""
                                    }}>{{ $data->name
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            @endif

        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
            <button type="submit" wire:click="manageFolder()" class="btn btn-primary">Update</button>
        </x-slot>
    </form>

</x-modal.basic-modal>
