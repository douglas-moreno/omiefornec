<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar Ped Compra</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8 md:mt-10 md:ml-10">
        <form action="{{ route('fornec.index') }}" method="get">
            @csrf
            @method('get')
            <div class="flex gap-4 items-center">
                <div>
                    <label for="inicial">Data inicial</label>
                    <input type="date" name="inicial" id="inicial" value="{{ old('data') }}" />
                </div>
                <div>
                    <label for="final">Data final</label>
                    <input type="date" name="final" id="final" value="{{ old('data') }}" />
                </div>
                <div>
                    <button type="submit">
                        Exportar
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
