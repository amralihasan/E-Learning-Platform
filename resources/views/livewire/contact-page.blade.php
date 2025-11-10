<div>
    <!-- Header Section -->
        <section class="bg-gradient-to-br from-primary-600 to-secondary-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
                <p class="text-xl text-primary-100">We'd love to hear from you. Get in touch with us!</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Form -->
                    <div>
                        <h2 class="text-3xl font-bold mb-6">Send us a Message</h2>
                        <form wire:submit.prevent="submit" class="space-y-6">
                            <div>
                                <x-input label="Name" wire:model="name" placeholder="Your name" />
                                @error('name') <span class="text-error-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <x-input type="email" label="Email" wire:model="email" placeholder="your.email@example.com" />
                                @error('email') <span class="text-error-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea 
                                    wire:model="message" 
                                    rows="6"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                    placeholder="Your message..."
                                ></textarea>
                                @error('message') <span class="text-error-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <x-button variant="primary" size="lg" type="submit" class="w-full">
                                Send Message
                            </x-button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <h2 class="text-3xl font-bold mb-6">Get in Touch</h2>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Address</h3>
                                    <p class="text-gray-600">123 Learning Street<br>Education City, EC 12345</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Phone</h3>
                                    <p class="text-gray-600">+1 (555) 123-4567</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Email</h3>
                                    <p class="text-gray-600">support@englishlearning.com</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Support Hours</h3>
                                    <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h3 class="font-semibold mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600 hover:bg-primary-200 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">Facebook</svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600 hover:bg-primary-200 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">Twitter</svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center text-primary-600 hover:bg-primary-200 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">LinkedIn</svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
