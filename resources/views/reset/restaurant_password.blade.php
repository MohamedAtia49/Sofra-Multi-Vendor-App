<x-mail::message>
# Introduction

Hello Mr. {{ $restaurant->name }}

<x-mail::button :url="'http://ipda3.com/'">
Reset Password
</x-mail::button>

Thanks,<br>
Mr. {{ $restaurant->name }}
</x-mail::message>
