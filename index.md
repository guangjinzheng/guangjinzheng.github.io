## Welcome to guangjinzheng Pages

You can use the [editor on GitHub](https://github.com/guangjinzheng/guangjinzheng.github.io/edit/main/index.md) to maintain and preview the content for your website in Markdown files.

Whenever you commit to this repository, GitHub Pages will run [Jekyll](https://jekyllrb.com/) to rebuild the pages in your site, from the content in your Markdown files.

### Markdown

Markdown is a lightweight and easy-to-use syntax for styling your writing. It includes conventions for

```markdown
Syntax highlighted code block

# Header 1
## Header 2
### Header 3

- Bulleted
- List

1. Numbered
2. List

from tensorflow.keras.applications.densenet import DenseNet201
from efficientnet.keras import EfficientNetB0
from tensorflow.keras import Model
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.optimizers import Adam
from tensorflow.keras.callbacks import LearningRateScheduler
from tensorflow.keras.layers import Dense, Dropout, GlobalAveragePooling2D, GlobalMaxPooling2D
from tensorflow.python.keras.layers import VersionAwareLayers
import tensorflow as tf
import datetime
import showplt
layers = VersionAwareLayers()

path = 'D:/deeplearning/datasets/plantsets/Oxford-102-flowers/'
modelx = 'EfficientNetB0'
class_total = 102
epochs = 100
w, h, d = 224, 224, 3
batch_sizes = 32

# learn rate
def lr_schedule(epoch=0, lr=1e-5):
    cls = '{}'.format(class_total)
    if cls == '17':
        epocharr = [20, 50, epochs]
        lrarr = [5e-5, 1e-5, 1e-6]
    elif cls == '102':
        epocharr = [20, 50, epochs]
        lrarr = [5e-5, 1e-5, 5e-6]

    if epoch < epocharr[0]:
        lr = lrarr[0]
    elif epoch < epocharr[1]:
        lr = lrarr[1]
    elif epoch < epocharr[2]:
        lr = lrarr[2]
    print('Learning rate: {:.1e}'.format(lr))
    return lr

# https://keras-cn-twkun.readthedocs.io/other/application/
def traintest():
    pre_trained_model = EfficientNetB0(input_shape=(w, h, d), weights='imagenet', include_top=False)
    x = pre_trained_model.output
    # Classification block
    x = GlobalAveragePooling2D(name='avg_pool')(x)
    # x = GlobalMaxPooling2D(name='max_pool')(x)
    x = Dense(1024, activation='relu')(x)
    x = Dropout(0.2)(x)

    # and a logistic layer -- let's say we have total classes
    predictions = Dense(class_total, activation='softmax')(x)
    model = Model(inputs=pre_trained_model.input, outputs=predictions)
    model.compile(optimizer=Adam(learning_rate=lr_schedule(0)),
                  loss='categorical_crossentropy', metrics=['accuracy'])
    model.summary()
    # train data
    train_datagen = ImageDataGenerator(rescale=1./255., rotation_range=40, width_shift_range=0.2,
                                       height_shift_range=0.2, shear_range=0.2, zoom_range=0.2,
                                       horizontal_flip=True)
    test_datagen = ImageDataGenerator(rescale=1.0/255.)
    train_generator = train_datagen.flow_from_directory("{}train/".format(path), batch_size=batch_sizes,
                                                        class_mode='categorical', target_size=(w, h))
    validation_generator = test_datagen.flow_from_directory("{}valid/".format(path), batch_size=batch_sizes,
                                                            class_mode='categorical', target_size=(w, h))
    test_generator = test_datagen.flow_from_directory("{}test/".format(path), batch_size=batch_sizes,
                                                      class_mode='categorical', target_size=(w, h))
    # class
    print('class:{}'.format(test_generator.class_indices))
    # callback
    timenow = datetime.datetime.now().strftime("%Y%m%d-%H%M%S")
    log_dir = "logs/{}/{}".format(modelx, timenow)
    tensorboard_callback = tf.keras.callbacks.TensorBoard(log_dir=log_dir, histogram_freq=1)
    cp_callback = tf.keras.callbacks.ModelCheckpoint(filepath="logs/cp/cp-{epoch:04d}.ckpt",
                                                     period=5, save_weights_only=True, verbose=1)
    lr_scheduler = LearningRateScheduler(lr_schedule)
    # load weights
    # model.load_weights("logs/cp/cp-0100.ckpt")
    history = model.fit(train_generator, validation_data=validation_generator,
                        epochs=epochs, callbacks=[tensorboard_callback, cp_callback, lr_scheduler])
    model.save('logs/{}/{}/{}model.h5'.format(modelx, timenow, modelx))
    showplt.history_csv_write(history.history, path='logs/{}/{}/{}plt.csv'.format(modelx, timenow, modelx))

    # Score trained model.
    scores = model.evaluate(test_generator)
    print('Test loss:', scores[0])
    print('Test accuracy:', scores[1])

if __name__ == '__main__':
    traintest()

# 2020-10-20 guangjinzheng keras plant-main Oxford 17 flowers
# true:264  total:272
# Test loss: 0.10662300884723663
# Test accuracy: 0.9756554365158081
# Top1 Accuracy: 97.566%
# Top5 Accuracy: 100.000%


**Bold** and _Italic_ and `Code` text

[Link](url) and ![Image](src)
```

For more details see [GitHub Flavored Markdown](https://guides.github.com/features/mastering-markdown/).

### Jekyll Themes

Your Pages site will use the layout and styles from the Jekyll theme you have selected in your [repository settings](https://github.com/guangjinzheng/guangjinzheng.github.io/settings). The name of this theme is saved in the Jekyll `_config.yml` configuration file.

### Support or Contact

Having trouble with Pages? Check out our [documentation](https://docs.github.com/categories/github-pages-basics/) or [contact support](https://github.com/contact) and we’ll help you sort it out.
