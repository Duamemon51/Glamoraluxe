<!-- resources/views/auth/verify.blade.php -->
<form method="POST" action="{{ route('verification.verify') }}">
    @csrf
    <label for="verification_code">Enter the verification code sent to your email:</label>
    <input type="text" name="verification_code" id="verification_code" required>
    <button type="submit">Verify</button>
</form>
