            <!-- Admins Section -->
            <div class="role-section mb-4">
                <h5>Admins</h5>
                <div class="card mb-3">
                    <div class="card-body p-3">

                        <!-- Table for Admins -->
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $index => $admin)
                                        <tr>
                                            <th scope="row">
                                                {{ $index + 1 + ($admins->currentPage() - 1) * $admins->perPage() }}
                                            </th>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    @if ($admin->profile_picture)
                                                        <img src="{{ asset('storage/' . $admin->profile_picture) }}"
                                                            alt="Profile Picture" style="width: 45px; height: 45px"
                                                            class="rounded-circle" loading="lazy">
                                                    @else
                                                        <div class="profile-picture-placeholder">
                                                            <img src="{{ asset('images/DefaultPicture.jpg') }}"
                                                                alt="Profile Picture" alt=""
                                                                style="width: 45px; height: 45px" class="rounded-circle"
                                                                loading="lazy">
                                                        </div>
                                                    @endif
                                                    <div class="ms-3">
                                                        <p class="fw-bold mb-1">{{ $admin->name }}</p>
                                                        <p class="text-muted mb-0">{{ $admin->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ ucfirst($admin->role) }}</td>
                                            <td>
                                                <!-- Action Buttons -->
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.users.show', $admin->id) }}"><img
                                                            src="{{ asset('images/svg/showuser.svg') }}"
                                                            class="svg-link"></a></a>
                                                    <a href="{{ route('admin.users.edit', $admin->id) }}"><img
                                                            src="{{ asset('images/svg/edit.svg') }}" class="svg-link"></a>

                                                    <!-- Delete Form -->
                                                    <form action="{{ route('admin.users.delete', $admin->id) }}"
                                                        method="POST" style="display:inline;"
                                                        onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link p-0">
                                                            <img src="{{ asset('images/svg/deleteuser.svg') }}"
                                                                class="svg-link" alt="Delete Admin"
                                                                style="width: 20px; height: 20px;">
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $admins->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
