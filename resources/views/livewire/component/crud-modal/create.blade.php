<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            New {{ $createType }}
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form enctype="multipart/form-data">
        <x-slot name="content">
            @if($createType=="folder")
            <div class="form-group">
                <h6>Folder Name</h6>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>
                                <x-heroicon-o-folder-plus style="height:15px ">
                                </x-heroicon-o-folder-plus>
                            </span>
                        </div>
                    </div>
                    <input type="text" wire:model="name" class="form-control" id="name" name="name">
                </div>
            </div>
            @elseif($createType=="file")
            <div class="form-group">
                <h6>File Name</h6>
                <div class="input-group mb-2">
                    <input type="text" wire:model="name" class="form-control" id="name" name="name">
                </div>
            </div>

            @elseif($createType =="url")
            <div class="form-group">
                <h6>URL Title</h6>
                <input type="text" wire:model="name" class="form-control" id="name" name="name">

            </div>
            <div class="input-group mb-2">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>
                                <x-heroicon-o-link style="height:15px ">
                                </x-heroicon-o-link>
                            </span>
                        </div>
                    </div>
                    <input type="text" wire:model="url" class="form-control" id="name" name="name">
                </div>
            </div>

            {{-- {{ $url }} --}}
            @endif

            <div class="access-radio">
                <h6>General Access</h6>
                <div class="custom-control custom-radio">
                    <input type="radio" wire:model="folderAccessType" id="is-private1" name="folderAccessType"
                        class="custom-control-input" value="public" checked>
                    <label class="custom-control-label" for="is-private1">Public</label>
                    <p>This project would be available to anyone who has the link</p>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" wire:model="folderAccessType" id="is-private2" class="custom-control-input"
                        value="private" name="folderAccessType">
                    <label class="custom-control-label" for="is-private2">Privates</label>
                    <p>Only people with access can open with the link</p>
                </div>
            </div>

            @if($folderAccessType == "private")
            <div class="form-group" id="formPrivate">
                <h6>Invite User</h6>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <select class="form-control" name="invitedUser" id="invitedUser" wire:model="invitedUsers">
                            <option value="">-</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <select class="form-control bg-primary text-white" name="accessType" id="accessType"
                                wire:model="invitedAccess">
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{ $invitedUsers }}||{{ $invitedAccess }}
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

            @if($createType=="file")
            <div class="form-group mb-3">
                <label for="customFile">Upload File</label>
                <div class="custom-file">
                    <input type="file" id="customFile" wire:model="file">
                </div>
            </div>
            @endif

            @if ($file)

            {{-- <img src="{{ $file}}"> --}}
            {{ $file }}
            @endif
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
            @if ($createType=="file")
            <button type="submit" wire:click="createFile('{{ $slug }}')" class="btn btn-primary">Create</button>
            @elseif($createType=="url")
            <button type="submit" wire:click="createURL('{{ $slug }}')" class="btn btn-primary">Create</button>
            @else
            <button type="submit" wire:click="createFolder('{{ $slug }}')" class="btn btn-primary">Create</button>
            @endif
        </x-slot>
    </form>
</x-modal.basic-modal>
