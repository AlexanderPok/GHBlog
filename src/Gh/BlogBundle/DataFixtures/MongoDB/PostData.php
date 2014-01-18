<?php

namespace Gh\GuestbookBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gh\BlogBundle\Document\Post;
use Gh\BlogBundle\Document\Tag;

class LoadPostData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = array(
            $this->getReference('computers'),
            $this->getReference('phones'),
            $this->getReference('smarts')
        );
        $tags = array();
        $tagNames = array('wtf', 'science', 'phones', 'ati');
        foreach ($tagNames as $tagName) {
            $tags[] = $tagName;
        }
        $content = $this->getContent();
        for ($i = 0; $i < 15; $i++) {
            $date = new \DateTime('2012-01-' . ($i + 1));
            $post = new Post();
            $post->setTitle($content[$i]['title']);
            $post->setText($content[$i]['text']);
            $post->setCategory($categories[rand(0,2)]);
            $post->setCreated($date);
            $post->setVisitCount(rand(0,5));
            $tagsIds = array_rand($tags, rand(1,2));
            if (is_array($tagsIds)) {
                $tagsArr = array();
                foreach ($tagsIds as $tagId) {
                    $tagsArr[] = $tags[$tagId];
                }
                $post->setTags($tagsArr);
            } else {
                $post->setTags(array($tags[$tagsIds]));
            }
            
            $manager->persist($post);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

    private function getContent()
    {
        $content = array();
        $content[] = array(
            'title' => "Bad Attitude? Depressed? Not Motivated? Learn the Skill of PR",
            'text' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consequat ipsum ac nibh aliquam, a sodales magna molestie. Maecenas urna sem, condimentum et mauris non, dictum convallis lorem. Morbi rutrum lorem id mi feugiat, in malesuada dui gravida. Nulla in ante metus. Pellentesque nec ullamcorper neque, vel tempus libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc placerat justo mi, nec tristique tortor congue et.",
        );
        $content[] = array(
            'title' => "The 7 Deadly Habits of Ineffective Sales People",
            'text' => "Morbi sollicitudin gravida pretium. Donec nec imperdiet justo. Integer et adipiscing tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque justo eros, eleifend ut massa et, iaculis vulputate ligula. Aenean metus purus, mollis non iaculis ullamcorper, sagittis at metus. Fusce luctus sit amet eros nec interdum. Maecenas sodales lacus laoreet, adipiscing dolor ac, consequat risus. Duis ligula dolor, ultrices eget mauris eu, bibendum porta justo. Phasellus tempus, enim id tincidunt ornare, libero mi laoreet nibh, id congue dui lectus et nunc. Aenean iaculis, metus nec bibendum luctus, ante lectus faucibus augue, non mattis est risus ac sem. Mauris sollicitudin arcu tempus lacinia rhoncus. Integer nec consequat quam, non blandit urna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas pellentesque lectus lobortis, elementum sem luctus, pharetra tortor. Proin vehicula dui eget leo dapibus cursus.",
        );
        $content[] = array(
            'title' => "Legends of Thailand: Jim Thompson and Amp John Fowler",
            'text' => "Nulla pharetra consectetur dolor id porta. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin egestas adipiscing enim, et vestibulum quam consectetur id. Nam quis ipsum suscipit, dictum elit vitae, iaculis ligula. Nullam at metus libero. Nulla facilisi. Aliquam commodo dui vitae nisi mollis pellentesque. In venenatis ornare volutpat. Proin et orci sit amet nisl ornare interdum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam feugiat, enim nec fringilla luctus, nunc lectus eleifend velit, in pretium quam arcu in libero.",
        );
        $content[] = array(
            'title' => "At Tax Time and Christmas, Its Murder!",
            'text' => "Ut arcu nunc, laoreet ut interdum id, consequat sit amet leo. Phasellus ac placerat dui. Sed porta est in facilisis rutrum. Mauris fringilla augue ac urna ultrices, in semper leo venenatis. Nunc ac euismod neque. Cras consectetur leo at imperdiet laoreet. Quisque molestie semper justo sed suscipit. Sed dapibus eget est ac gravida. Nam eget iaculis velit. Donec faucibus, sem eu interdum blandit, ipsum nisl molestie lectus, sed semper leo sem consequat est. Aliquam pharetra lacus nec dapibus facilisis. Maecenas sagittis orci eget diam pharetra iaculis. Mauris et mattis mi, quis hendrerit nisi. Sed in semper sapien. Praesent sit amet vestibulum lacus. Nullam ut libero et enim rutrum aliquet ac id leo.",
        );
        $content[] = array(
            'title' => "History by Art Abraaj Capital Art Prize, 2012 Spectral Imprints",
            'text' => "Nulla vitae venenatis ipsum. Donec vel nisl libero. Nullam viverra metus dolor. Fusce vel congue nulla. Integer id augue vel enim rhoncus gravida at a turpis. Donec fringilla placerat sem nec dignissim. Aenean dignissim consequat erat. Integer dictum sem nunc, in faucibus leo volutpat eu. Aenean mattis sagittis purus, vel aliquam lorem suscipit nec. Nulla bibendum risus non massa venenatis, nec interdum libero laoreet. Etiam luctus lacus quis euismod semper. Maecenas posuere semper neque, eget egestas orci euismod at. Ut bibendum urna vitae erat gravida, vel tristique est suscipit. Vestibulum ac laoreet nibh. Vestibulum cursus blandit risus, et luctus ipsum placerat eu. Nam eget aliquet diam.",
        );
        $content[] = array(
            'title' => "Loneliness Versus Conformation A Snapshot From The Life Of An Indian Girl",
            'text' => "In hac habitasse platea dictumst. Etiam vitae dignissim massa. Proin adipiscing, nibh at convallis rutrum, lacus nunc feugiat purus, non tristique ligula velit imperdiet dolor. Nulla aliquet nulla ipsum, quis lacinia ligula sodales at. Donec a venenatis turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla mi lacus, consequat ut lorem sed, elementum dictum ipsum.",
        );
        $content[] = array(
            'title' => "The 1st Thing Every Actor Must Know",
            'text' => "Integer porta sit amet mauris vitae consequat. Vivamus tristique tortor quis turpis convallis, ut congue lectus accumsan. Vivamus egestas arcu a sem aliquam, non pretium elit sollicitudin. Nunc elementum placerat odio, eu laoreet quam accumsan non. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla suscipit, nunc ut tristique hendrerit, arcu neque faucibus nulla, vitae placerat metus elit nec quam. Nam imperdiet nec magna nec vulputate. Suspendisse enim nisl, dictum et mi a, porta aliquet metus. Sed ultricies eget nibh ac vestibulum.",
        );
        $content[] = array(
            'title' => "Photo Frames: The Best Practices In Choosing The Ideal Frame",
            'text' => "Vestibulum sed nisi libero. Aenean porttitor nunc non dignissim aliquet. Aenean malesuada enim sed nibh imperdiet sollicitudin. Vivamus et leo at nunc varius pulvinar. Vivamus condimentum velit in elit pharetra, at mattis arcu varius. Suspendisse dapibus non turpis eget rhoncus. Suspendisse faucibus quam non dui porttitor auctor. Sed convallis commodo massa sed vehicula. Vestibulum placerat dolor nec eros vulputate pulvinar. Curabitur vel fringilla odio.",
        );
        $content[] = array(
            'title' => "Recordkeeping, Part 1: What to Keep and for How Long",
            'text' => "Vivamus varius egestas eros eget consectetur. Mauris eu mattis metus. Cras malesuada, mauris sit amet auctor mollis, nulla risus rutrum augue, vel rutrum leo orci sit amet nulla. Proin aliquam condimentum tempor. Morbi luctus, neque sit amet tempus dictum, velit nibh facilisis elit, ut lobortis lorem neque eu lectus. Fusce lectus ipsum, gravida ac tortor vitae, lobortis mattis velit. Pellentesque vel libero nec ligula fringilla venenatis. Cras congue dapibus nisi, et bibendum velit tempor eget.",
        );
        $content[] = array(
            'title' => "Creativity for Live Events Entertainment",
            'text' => "Fusce eleifend tortor in tincidunt ullamcorper. Ut commodo, libero sit amet convallis tempor, arcu urna tempus lorem, ac adipiscing nibh erat at enim. Vestibulum lobortis mollis enim, sit amet pulvinar lorem molestie nec. Suspendisse consequat gravida quam eu mattis. Cras eu dolor sem. Morbi dui mi, pellentesque quis varius et, tristique sed nulla. Aliquam in odio in ante ornare sodales. Aliquam erat volutpat. Cras faucibus mauris posuere eros fermentum porttitor. Vestibulum iaculis elit id neque tincidunt, non varius libero tristique. Ut bibendum sodales lorem vitae porttitor. Vestibulum venenatis sem augue, vitae faucibus mi posuere sed.",
        );
        $content[] = array(
            'title' => "Benefits Of Glass Mosaic Tiles For Your Kids",
            'text' => "Fusce venenatis, neque sed elementum euismod, leo eros sodales nunc, in sollicitudin lorem tellus non nulla. Maecenas consectetur auctor urna eu luctus. Fusce faucibus ipsum sem, in rhoncus nibh ultrices eget. Nunc tortor metus, egestas sed metus id, luctus condimentum nunc. Aliquam risus augue, fermentum ac cursus vitae, congue eu nisl. Curabitur gravida purus non elit iaculis semper. Curabitur ut augue quis diam porttitor lobortis. Duis sodales libero tellus, nec sagittis enim mollis quis. Proin et ligula a magna tincidunt posuere.",
        );
        $content[] = array(
            'title' => "Does Your Marketing Make Your Recording Studio Invisible?",
            'text' => "Donec tempor dui non fermentum iaculis. Donec vulputate varius lacus eget elementum. Suspendisse sed est eu justo venenatis pretium a sit amet neque. Nunc ac convallis sem, vitae gravida mi. Ut malesuada lectus tortor, vitae lacinia urna tempor eget. Mauris tellus orci, interdum in lectus eu, tempus cursus ipsum. Aenean ullamcorper at tellus eget ullamcorper. Duis egestas nulla eget est sollicitudin aliquam. Suspendisse blandit lorem lacus, sit amet ullamcorper nulla volutpat vitae. Quisque consectetur elit magna, id pretium arcu pulvinar vel. Proin placerat magna a justo tincidunt eleifend. Donec sed odio rutrum, porta neque ac, commodo elit. In tristique sagittis est, non ultricies velit malesuada vitae.",
        );
        $content[] = array(
            'title' => "How to Survive a Boring Managers Meeting",
            'text' => "In hac habitasse platea dictumst. Vestibulum mollis in lorem quis ornare. Nam hendrerit, justo a varius dictum, augue mauris porttitor odio, et dapibus lorem eros sit amet sapien. Pellentesque vitae nulla euismod, bibendum orci nec, imperdiet dolor. Maecenas eget leo venenatis, fringilla turpis non, pellentesque orci. Fusce cursus mollis quam, vel aliquam dolor euismod at. Nulla in risus turpis. Etiam mollis, velit sed lacinia gravida, quam urna hendrerit tellus, nec gravida tellus nisl sit amet lorem. Phasellus consectetur felis vitae justo dapibus posuere. Vestibulum imperdiet aliquam porttitor. Phasellus quis quam non nunc consectetur tincidunt. Morbi pulvinar eget nunc sit amet ultricies. Curabitur dictum mauris ut molestie imperdiet.",
        );
        $content[] = array(
            'title' => "Good Faith What You Need to Know",
            'text' => "Integer congue elit purus, et dapibus elit blandit vel. Fusce euismod dui ac fermentum consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam libero sem, scelerisque non lorem nec, rhoncus fringilla odio. Aliquam ut porta lacus. Vivamus et eros ligula. Morbi nunc urna, sodales facilisis purus eget, eleifend commodo ligula. Phasellus suscipit luctus augue ac fringilla. Curabitur id ipsum est. Donec in diam ut mauris placerat eleifend. Nulla rhoncus vulputate tortor sed mollis. Etiam vel est mi. Etiam a mauris eget lacus suscipit scelerisque. Proin feugiat, leo nec placerat sodales, risus ligula commodo nisi, et tempor nisl orci sed nunc. Phasellus egestas consequat neque nec malesuada.",
        );
        $content[] = array(
            'title' => "How To Develop A Healthy Voice",
            'text' => "Curabitur eu scelerisque ipsum, ac gravida felis. Sed id felis justo. Donec sed ante consectetur, convallis velit sit amet, auctor felis. Morbi mollis tincidunt ligula, et eleifend elit pharetra in. Curabitur hendrerit massa leo. Nullam dignissim imperdiet quam, et pretium nulla sodales in. Etiam mollis velit ligula, et convallis eros scelerisque quis. Mauris ligula arcu, gravida ac turpis eget, auctor gravida odio.",
        );
        return $content;
    }
}