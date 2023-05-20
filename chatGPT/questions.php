<?php


require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

use Orhanerday\OpenAi\OpenAi;


$gpt = new Questions();
$title = '做外贸或者跨境电商，有哪些神器推荐？';
echo $title . "\r\n";
$rs = $gpt->getOpenAiResult($title);
var_dump($rs);

class Questions
{
  private $open_ai;

  function __construct()
  {
    $open_ai_key = "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";
    $this->open_ai = new OpenAi($open_ai_key);
  }

  function getOpenAiResult($item)
  {
    $messages = [
      [
        "role" => "system",
        "content" => "你是一个在线新媒体营销专家,你也是一个TikTok卖家,你非常了解TikTok/抖音/自媒体的各种营销手段/卖家全链路的知识,你也是一个经验丰富的卖家"
      ],
      [
        "role" => "user",
        "content" => "帮我把下面的问题,用更吸引人的方式重写一遍,保持字数长度和原来的一样:"
      ],
      [
        "role" => "assistant",
        "content" => $item
      ]
    ];

    $chat = $this->open_ai->chat([
      'model' => 'gpt-3.5-turbo',
      'messages' => $messages,
      'temperature' => 1.0,
      // 'max_tokens' => 4000,
      'frequency_penalty' => 0,
      'presence_penalty' => 0,
    ]);

    $d = json_decode($chat);

    var_dump($d);

    if (isset($d->choices[0]->message->content)) {
      return $d->choices[0]->message->content;
    }
    return false;

  }

  function getRewriteTitle($title)
  {

    $newTitle = $title;
    return $newTitle;

  }
}