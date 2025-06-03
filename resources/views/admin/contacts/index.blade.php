@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-dark mb-4">📬 Contact Messages</h2>

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="custom-softmax-header">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Actions</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $message)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $message->first_name }} {{ $message->last_name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject ?? '—' }}</td>
                            <td>
                                <div class="message-icon-wrapper">
                                    @if (!$message->is_read)
                                        <span class="unread-dot"></span>
                                    @endif
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#messageModal{{ $message->id }}" title="View Message">
                                        <i class="bi bi-envelope-fill text-{{ $message->is_read ? 'secondary' : 'primary' }}" style="font-size: 1.2rem;"></i>
                                    </a>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">
                                                    📩 Message from {{ $message->first_name }} {{ $message->last_name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $message->message }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex flex-column flex-sm-row justify-content-center gap-1">
                                    <form action="{{ route('admin.contacts.toggleRead', $message->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-warning" title="Toggle Read/Unread" id="toggle-btn-{{ $message->id }}">
                                            <i class="bi {{ $message->is_read ? 'bi-envelope-open' : 'bi-envelope' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Delete" id="delete-btn-{{ $message->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <td>{{ $message->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted text-center">No messages yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    thead.custom-softmax-header th {
        background-color: #EE4266;
        color: white;
    }

    .btn {
        border-radius: 20px;
    }

    .btn-sm {
        font-size: 0.85rem;
    }

    .message-icon-wrapper {
        position: relative;
        display: inline-block;
    }

    .unread-dot {
        position: absolute;
        top: -6px;
        right: -6px;
        width: 8px;
        height: 8px;
        background-color: #EE4266;
        border-radius: 50%;
        animation: pulse 1s infinite ease-in-out;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.5);
            opacity: 0.5;
        }
    }

    @media (max-width: 768px) {
        .d-flex.flex-sm-row {
            flex-direction: column !important;
        }

        .d-flex.flex-sm-row .btn {
            width: 100%;
        }
    }
</style>
