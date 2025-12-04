<div>
    @if($submitted)
        <div class="alert alert-success small mb-3">Your enquiry has been submitted. We will contact you soon.</div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="position-relative form-group mb-5px">
            <span class="form-icon"><i class="bi bi-emoji-smile icon-small"></i></span>
            <input wire:model.defer="name" class="ps-0 border-radius-0px border-color-transparent-dark-very-light bg-transparent form-control required @error('name') is-invalid @enderror" name="name" type="text" placeholder="Your name*" />
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="position-relative form-group mb-5px">
            <span class="form-icon"><i class="bi bi-telephone icon-small"></i></span>
            <input wire:model.defer="phone" class="ps-0 border-radius-0px border-color-transparent-dark-very-light bg-transparent form-control required @error('phone') is-invalid @enderror" type="tel" name="phone" placeholder="Your phone*" />
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="position-relative form-group mb-5px">
            <span class="form-icon"><i class="bi bi-envelope icon-small"></i></span>
            <input wire:model.defer="email" class="ps-0 border-radius-0px border-color-transparent-dark-very-light bg-transparent form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Your email" />
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="position-relative form-group form-textarea mb-0">
            <textarea wire:model.defer="message" class="ps-0 border-radius-0px border-bottom border-color-transparent-dark-very-light bg-transparent form-control" name="message" placeholder="Your message" rows="2"></textarea>
            <span class="form-icon"><i class="bi bi-chat-square-dots icon-small"></i></span>
            <input type="hidden" name="tour_id" wire:model.defer="tour_id" />
            <button class="btn btn-medium btn-dark-gray btn-round-edge btn-box-shadow mt-25px w-100 submit" type="submit" aria-label="submit">Send message</button>
        </div>
    </form>
</div>
