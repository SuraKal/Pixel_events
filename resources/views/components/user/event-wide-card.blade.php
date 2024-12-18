                @props(['event'])


                <a href="{{ route('event.show', $event) }}" class="block">
                    <ul role="list" class="divide-y divide-gray-100">
                        <x-panel class="flex flex-col text-start">
                            <li class="flex justify-between gap-x-1 py-1">
                                <div class="flex min-w-0 gap-x-4">
                                    {{-- @foreach($event->images as $image)
                                <img class="size-12 flex-none rounded bg-gray-50"
                                    src="{{ $image->image_path }}"
                                    alt="">
                                    @endforeach --}}

                                    <div class="min-w-0 flex-auto">
                                        <p class="text-md/6 font-semibold text-white-900">{{ $event->name }}</p>
                                        <p class="mt-1 truncate text-sm/5 text-gray-400">{{ $event->location }}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p class="text-sm/6 text-white-900 rounded border py-1 px-2 border-white/10">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </p>


                                    <p class="mt-1 text-xs/5 text-white-500">{{ $event->date }}
                                    </p>
                                    {{-- <p class="mt-1 text-xs/5 text-white-500">Posted <time datetime="2023-01-23T13:23Z">3h
                                        ago</time>
                                </p> --}}

                                </div>
                            </li>
                        </x-panel>
                    </ul>
                </a>
