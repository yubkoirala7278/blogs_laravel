@extends('frontend.layout.master')

@section('content')
    <main>
        <section class="section">
            <div class="container">
                <div class="row no-gutters-lg">
                    <div class="col-md-8">
                        <h2 class="section-title">महेश अधिकारी बर्बरीक</h2>
                        <img src="{{ asset('frontend/images/author.jpg') }}" alt="Author Image" class="img-fluid mb-3">
                        <p>
                            नेपाली पत्रकारिता जगतमा चिर परिचित नाम, महेश अधिकारी बर्बरीक एक प्रतिष्ठित लेखक तथा राजनीतिक
                            रिपोर्टर हुनुहुन्छ। उत्कृष्ट लेखन र गहिरो विश्लेषण क्षमताका धनी उहाँले आफ्नो करियरको सुरुवात
                            समाचारपत्र लेखनबाटै गर्नुभएको थियो। लामो समयदेखि राजनीतिक रिपोर्टिङमा ख्याति कमाउनुभएका उहाँले
                            यस क्षेत्रमा आफ्नो विशेष पहिचान बनाउनुभएको छ।
                        </p>

                        <p>
                            सत्य र तथ्यमा आधारित समाचार सम्प्रेषणमा सदैव प्रतिबद्ध, महेशले निरन्तर सटीक र निष्पक्ष रिपोर्टिङ
                            गर्ने प्रयास गर्नुभएको छ। उहाँका लेखहरू समसामयिक विषयवस्तुको गहिरो विश्लेषण र तथ्यपरक
                            अनुसन्धानबाट भरिपूर्ण हुन्छन्, जसले पाठकहरूलाई विस्तृत दृष्टिकोण प्रदान गर्दछ।
                        </p>

                        <p>
                            बगैंचा घटनाक्रम र निर्वाचनहरूको व्यापक कभरेज गर्नुभएका महेशले आफ्नो रिपोर्टिङमा सधैं निष्पक्षता
                            र संतुलनलाई प्राथमिकता दिनुहुन्छ। यसैले उहाँका रिपोर्टहरू पाठकहरूका लागि सत्य र भरपर्दो स्रोत
                            साबित भएका छन्। निरन्तरको कठोर परिश्रम र समर्पणले उहाँलाई नेपाली पत्रकारिता क्षेत्रको उच्च
                            स्थानमा पुर्‍याएको छ।
                        </p>

                        <p>
                            महेश अधिकारी बर्बरीकको मूल उद्देश्य भनेको समाजमा जागरूकता फैलाउनु र आफ्ना पाठकहरूलाई सही र
                            भरपर्दो जानकारी प्रदान गर्नु हो। नेपाली पत्रकारिता र राजनीतिक चेतना विकासमा उहाँको योगदान
                            अतुलनीय छ। यही निष्ठाले उहाँलाई यस क्षेत्रमा सफलताको शिखरमा पुर्याएको छ।
                        </p>



                    </div>
                    <div class="col-md-4">
                        <div class="col-12">
                            <div class="widget">
                                <h2 class="section-title mb-3">Categories</h2>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $category)
                                                <li><a href="{{ route('frontend.category', $category->id) }}">{{ $category->category }}<span
                                                            class="ml-auto">({{ $category->posts_count }})</span></a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li>No categories to display...</li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="widget">
                                <h2 class="section-title mb-3">Tags</h2>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        @if (count($tags))
                                            @foreach ($tags as $tag)
                                                <li><a href="{{ route('frontend.tag', $tag) }}">{{ $tag->tag }}<span
                                                            class="ml-auto">({{ $tag->posts_count }})</span></a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li>No tags to display...</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
