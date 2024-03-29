<x-mail::message>
# Introduction

Hello Mr. {{ $client->name }}

<x-mail::button :url="'http://ipda3.com/'">
Reset Password
</x-mail::button>

Thanks,<br>
Mr. {{ $client->name }}
</x-mail::message>
