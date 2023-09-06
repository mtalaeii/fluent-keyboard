<div id="top"></div>

# fluent-keyboard
A fluent keyboard created for MTProto syntax

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#installation">Installation</a></li>
    <li>
        <a href="#usage">Usage</a>
        <ol>
            <li><a href="#defining-a-keyboard">Defining a Keyboard</a></li>
            <li><a href="#defining-buttons">Defining Buttons</a></li>
            <li>
                <a href="#bind-buttons-to-a-keyboard">Bind Buttons to a Keyboard</a>
                <ol>
                    <li><a href="#by-row">By Row</a></li>
                    <li><a href="#by-button">By Button</a></li>
                    <li><a href="#as-stack">As Stack</a></li>
                </ol>
            </li>
            <li><a href="#keyboardforcereply-and-keyboardhide">KeyboardForceReply and KeyboardHide</a></li>
            <li><a href="#keyboard-peer-type">Keyboard Peer Type</a></li>
            <li><a href="#convert-telegram-keyboard-to-fluent-keyboard">Convert Telegram Keyboard To Fluent Keyboard</a></li>
        </ol>
    </li>
  </ol>
</details>

## Installation

Install the package using composer:

```shell
composer require easy-keyboard/fluent-keyboard
```

<p align="right">(<a href="#top">back to top</a>)</p>

## Usage

If you need to create a keyboard you can use the classes provided by this package as a drop-in replacement.

This is best explained with an example:

```php
$this->messages->sendMessage(
    chat_id:       12345,
    text:          'Keyboard Example',
    reply_markup:  KeyboardMarkup::new()
        ->singleUse()
        ->addButton(KeyboardButton::Text('Cancel'))
        ->addButton(KeyboardButton::Text('OK'))
        ->build()
);
```

A ReplyKeyboardMarkup is created by calling the static `new()` method on `KeyboardMarkup`. After that every field,
like `singleUse`, ... add some extras. Buttons can be added by calling
the `addButton()` method. We have a detailed look on that later.(note that this keyboard need to convert to array to 
readable by your robot so at the end you need to call `init()` method)

<p align="right">(<a href="#top">back to top</a>)</p>

### Defining a Keyboard

You can create a keyboard by calling the static `new()` method on its class.

After that you can chain methods to set additional fields that are available in the Bot API. This is done by calling the
`placeholder()` method.

```php
KeyboardMarkup::new()
    ->placeholder('Placeholder')
    ->build();
```

<p align="right">(<a href="#top">back to top</a>)</p>

### Defining Buttons

The Buttons are created in the different way:

```php
KeyboardButton::Phone('Send my Contact');
```

This is done the same way for `InlineButton`:

```php
InlineButton::Url('hello','https://example.com');
```

<p align="right">(<a href="#top">back to top</a>)</p>

### Bind Buttons to a Keyboard

The keyboard does not work without any buttons, so you need to pass the buttons to the keyboard. There are a few ways to
do this.

#### By Row

```php
KeyboardMarkup::new()
    ->row(
        KeyboardButton::Text('Cancel'),
        KeyboardButton::Text('OK')
    )
    ->build();
```

If you need more than one row, call `row()` multiple times:

```php
KeyboardInline::new()
    ->row(
        InlineButton::Callback('1','page-1'),
        InlineButton::Callback('2','page-2'),
        InlineButton::Callback('3','page-3')
    )
    ->row(
        InlineButton::Callback('prev','page-prev'),
        InlineButton::Callback('next','page-next')
    )
    ->build();
```
You can add array of callbacks or texts keyboard in another way!
```php
KeyboardInline::new()
    ->addCallbacks([
        '1' => 'page-1',
        '2' => 'page-2',
        '3' => 'page-3',
    ],[
        'prev' => 'page-prev',
        'next' => 'page-next'
    ])
    ->build();
```
```php
KeyboardMarkup::new()
    ->addTexts([
       'Cancel',
       'Ok'
    ])
    ->build();
```
#### By Button

```php
KeyboardMarkup::new()
    ->addButton(KeyboardButton::Text('First Button'))
    ->addButton(KeyboardButton::Text('Second Button'))
    ->build();
```

If you need more than one row, just call the row method without arguments, and continue calling `addButton()`:

```php
KeyboardInline::new()
    ->addButton(InlineButton::Callback('A','answer-a'))
    ->addButton(InlineButton::Callback('B','answer-b'))
    ->row()
    ->addButton(InlineButton::Callback('C','answer-c'))
    ->addButton(InlineButton::Callback('D','answer-d'))
    ->build();
```

It's up to you if you define your buttons inline like in these examples or if you'd like to generate a whole row beforehand and
pass the variable to the `row()` method.

#### As Stack

If you want to add a bunch of buttons that have each a row for themselves you can use the `Stack()` method.

```php
KeyboardInline::new()
    ->Stack(
        InlineButton::Login('Login','https://example.com/login'),
        InlineButton::Url('Visit Homepage','https://example.com')
    )
    ->build();
```


**You can mix and match the `row()`, `Stack()` and `addButton()` methods as it fits your needs.**

<p align="right">(<a href="#top">back to top</a>)</p>

### KeyboardForceReply and KeyboardHide

KeyboardForceReply and KeyboardHide can be used the same way as a normal keyboard, but they do not receive any buttons:

```php
#[FilterAnd(new FilterPrivate,new FilterIncoming)]
public function handleExit(Message $message){
    $message->reply('Thank you',
        reply_markup : KeyboardHide::new()->build()
    );
}

```

```php
$data['reply_markup'] = KeyboardForceReply::new()
    ->addButton(KeyboardButton::Text('Hello please reply'))
    ->placeholder('must reply')
    ->build();
```

<p align="right">(<a href="#top">back to top</a>)</p>

### Keyboard Peer Type

We have 3 types of peer type can be requested by bots RequestPeerTypeUser , RequestPeerTypeChat and RequestPeerTypeBroadcast

```php
KeyboardMarkup::new()
    ->addButton(KeyboardButton::Peer('Request for user',0,RequestPeerTypeUser::new()));
```
```php
KeyboardMarkup::new()
    ->addButton(KeyboardButton::Peer('Request for chat',1,RequestPeerTypeChat::new()));
```
```php
KeyboardMarkup::new()
    ->addButton(KeyboardButton::Peer('Request for broadcast',2,RequestPeerTypeBroadcast::new()));
```
**You can also use easier syntax to create better one**

```php
KeyboardMarkup::new()
    ->requestUser('Request for user',0);
```
```php
KeyboardMarkup::new()
    ->requestChat('Request for chat',1);
```
```php
KeyboardMarkup::new()
    ->requestChannel('Request for broadcast',2);
```
<p align="right">(<a href="#top">back to top</a>)</p>

### Convert Telegram Keyboard To Fluent Keyboard

You can now easily convert mtproto telegram keyboards to fluent keyboard for modify and ...
using `fromRawReplyMarkup` methods! here is and example

```php
$fluentKeyboard = Keyboard::fromRawReplyMarkup($replyMarkup);
```
As you know `$fluentKeyboard` is object here and you can modify and add more buttons to it.
here is an example if `$flunentKeyboard` instance of `KeyboardInline`

```php
$fluentKeyboard->addButton(InlineButton::Callback('End','End'));
```
At the end you can call `build` method on that and pass to some telegram method here is an
example for [MadelineProto](https://github.com/danog/MadelineProto) :

```php
#[FilterAnd(new FilterPrivate,new FilterIncoming)]
public function modify(Message $message){
    $message->reply('That is new keyboard',
        reply_markup : $fluentKeyboard->build()
    );
}
```
<p align="right">(<a href="#top">back to top</a>)</p>