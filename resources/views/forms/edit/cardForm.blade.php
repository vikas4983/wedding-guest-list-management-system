 <form id="createGuest" action="{{ route('cards.update', $objectdata->id) }}" method="post" enctype="multipart/form-data">
     @csrf
     @method('PATCH')
     <div class="row">
         <div class="form-group col-lg-3 mt-5">
             <label for="event_id" class="font-weight-medium">{{ __('labels.card_name') }}</label>
             <select class="form-control @error('event_id') is-invalid @enderror" name="event_id" id="event_id">
                 @foreach ($data['events'] as $event)
                 @dump($event->id)
                     <option value="{{ $event->id }}" {{ old('event_id',$objectdata->event_id) === $event->id ? 'selected' : '' }}>
                         {{ ucfirst($event->name) }}
                     </option>
                 @endforeach
             </select>
             @error('event_id')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>

         <div class="form-group col-lg-3 mt-5">
             <label for="image" class="font-weight-medium">{{ __('labels.card_image') }}</label>
             <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                 id="image" value="{{ $objectdata->image }}">
             @error('image')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
         <div class="form-group col-lg-3 mt-5">
             <label for="date" class="font-weight-medium">{{ __('labels.card_date') }}</label>
             <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                 id="date" value="{{ $objectdata->date }}" required>
             @error('date')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
         <div class="form-group col-lg-3 mt-5">
             <label for="time" class="font-weight-medium">{{ __('labels.card_time') }}</label>
             <input type="time" class="form-control @error('time') is-invalid @enderror" name="time"
                 id="time" value="{{ $objectdata->time }}"required>
             @error('time')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
     </div>

     <div class="row">
         <div class="form-group col-lg-3 mt-5">
             <label for="title" class="font-weight-medium">{{ __('labels.card_title_name') }}</label>
             <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                 id="title" placeholder="{{ __('labels.card_title_name_placeholder') }}"
                 value="{{ $objectdata->title }}" required>
             @error('title')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
         <div class="form-group col-lg-3 mt-5">
             <label for="location" class="font-weight-medium">{{ __('labels.card_location') }}</label>
             <input type="text" class="form-control @error('location') is-invalid @enderror" name="location"
                 id="location" placeholder="{{ __('labels.card_location_placeholder') }}"
                 value="{{ $objectdata->location }}">
             @error('location')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
         <div class="form-group col-lg-3 mt-5">
             <label for="address" class="font-weight-medium">{{ __('labels.card_address') }}</label>
             <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                 id="address" placeholder="{{ __('labels.card_address_placeholder') }}"
                 value="{{ $objectdata->address }}" required>
             @error('address')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
         <div class="form-group col-lg-3 mt-5">
             <label for="description" class="font-weight-medium">{{ __('labels.card_description') }}</label>
             <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                 id="description" placeholder="{{ __('labels.card_description_placeholder') }}"
                 value="{{ $objectdata->description }}">
             @error('description')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
     </div>

     <div class="row">
         <div class="form-group col-lg-3 mt-5">
             <label for="theme_color" class="font-weight-medium">{{ __('labels.card_theme_color') }}</label>
             <input type="text" class="form-control @error('theme_color') is-invalid @enderror" name="theme_color"
                 id="theme_color" placeholder="{{ __('labels.card_theme_color_placeholder') }}"
                 value="{{ $objectdata->theme_color }}">
             @error('theme_color')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
         <div class="form-group col-lg-3 mt-5">
             <label for="rsvp_link" class="font-weight-medium">{{ __('labels.card_rsvp_link') }}</label>
             <input type="text" class="form-control @error('rsvp_link') is-invalid @enderror" name="rsvp_link"
                 id="rsvp_link" placeholder="{{ __('labels.card_rsvp_link_placeholder') }}"
                 value="{{ $objectdata->rsvp_link }}">
             @error('rsvp_link')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
         <div class="form-group col-lg-6  mt-5">
             <div class="form-group  d-flex justify-content-between align-items-right">
                 <label for="is_active" class="font-weight-medium mb-5">{{ __('labels.status') }}</label>
                 <div class="switch-container">
                    <div class="row mt-5 " style="width:300px">
                         <label class="switch switch-text switch-primary switch-pill form-control-label">
                             <input type="checkbox" name="is_active" id="is_active"
                                 class="switch-input form-check-input" value= "1"
                                 {{ old('is_active', $objectdata->is_active) === 1 ? 'checked' : '' }} required>
                             <span class="switch-label" data-on="ON" data-off="OFF"></span>
                             <span class="switch-handle"></span>
                         </label>
                     </div>
                 </div>
                 @error('is_active')
                     <div class="invalid-feedback d-block">
                         {{ $message }}
                     </div>
                 @enderror
             </div>
         </div>
     </div>
     <div class="row">
         <div class="form-group col-lg-12 mt-5">
             <label for="html" class="font-weight-medium">{{ __('labels.card_html') }}</label>

             <textarea name="html" class="form-control" id="html" cols="5" rows="5" required
                 placeholder="{{ __('labels.card_html_placeholder') }}">
    {{ old('html', $objectdata->html ?? '') }}
</textarea>

             @error('html')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
         </div>
     </div>
     <div class="row mt-5">
         <div class="col text-center">
             <button type="submit" id="submitBtn" title="{{ __('titles.add_card') }}"
                 class="btn btn-primary">{{ __('buttons.create') }}</button>
         </div>
     </div>
 </form>
