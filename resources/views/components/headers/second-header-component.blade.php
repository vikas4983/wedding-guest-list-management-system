<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center" style="gap: 1rem;">
            <a href="{{$createRoute}}" class="btn btn-info">Add Guest</a>
            <form id="sendInvitation" style="display: none" action="{{$invitationRoute}}" method="post" class="m-0 ">
                @csrf
                <button type="button" id="invitationBtn" disabled class="btn btn-info">Send
                    Invitation</button>
            </form>
        </div>
        <div class="input-group" style="width: 100">
            <input type="text" class="form-control mt-3" placeholder="Enter name, mobile, email...">
            <button id="searchBtn" class="input-group-text" type="button">
                <i class="mdi mdi-account-search-outline"></i>
            </button>
        </div>
    </div>