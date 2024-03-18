<div class="pt-10">
    <main class="wrapper w-full md:max-w-5xl mx-auto px-4 space-y-5">
        <header>
            <div>
                <h1 class="text-3xl text-center font-bold text-gray-950 dark:text-white">
                    تقرير عن أسرة {{ $family->name }}
                </h1>
            </div>
        </header>
        <section class="">
            {{ $this->familyInfolist }}
        </section>
        <section class="">
            {{ $this->table }}
        </section>
        <section class="flex justify-between items-center">
            <p class="text-lg">
                تمت الطباعة بواسطة
                <br />
                <span class="font-bold">{{ Auth::user()->name }}</span>
                <br />
                <span>{{ \Carbon\Carbon::now()->format("يوم d - شهر m - سنة Y") }}</span>
            </p>

            <!--
                <div class="border-2 border-black rounded-lg py-2 px-4">
                    <p class="text-lg">رقم الاسرة: {{ $family->id }}</p>
                    <p class="text-lg">الاب الكاهن التابع لهم: {{ $family->priest?->name }}</p>
                </div>
            -->

            {!! QrCode::size(100)->generate(app("App\Filament\Resources\FamilyResource")::getUrl("view", ["record" => $this->family ])) !!}

        </section>
    </main>
</div>